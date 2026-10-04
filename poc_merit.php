<?php
// 1. FORCE PHP TO SHOW THE EXACT ERROR INSTEAD OF STOPPING BLANK
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: text/plain");

$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID"=>"sa","PWD"=>$pw,"LoginTimeout"=>8));

if (!$c) { 
    die("CONNECTION FAILED: " . print_r(sqlsrv_errors(), true)); 
}

// Target tables
$tables = [
    "web_ca_UGMeritResult",
    "tbl_Admin_Results",
    "tbl_Admin_ResultFileDetails",
    "NET",
    "web_ca_UGSelectionList",
    "tbl_ca_login",
    "tbl_ca_Candidate"
];

foreach ($tables as $table) {
    echo "\n=== data in ugadmission2025.{$table} ===\n";
    
    $query = "SELECT TOP 50 * FROM ugadmission2025.dbo.{$table};";
    $r2 = sqlsrv_query($c, $query);
    
    // Check if SQL query itself failed (e.g., column/table doesn't exist)
    if ($r2 === false) {
        echo "SQL ERROR: Failed to execute query.\n";
        print_r(sqlsrv_errors());
        continue;
    }
    
    $rowCount = 0;
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_ASSOC)) {
        $rowCount++;
        // Print the columns dynamically by key-value pairing to avoid index crashes
        foreach($row as $columnName => $value) {
            // Format dates if any column holds a DateTime object
            if ($value instanceof DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }
            echo "[{$columnName}]: {$value} | ";
        }
        echo "\n";
    }
    
    if ($rowCount === 0) {
        echo "(Table is empty - 0 rows returned)\n";
    }
    
    sqlsrv_free_stmt($r2);
}

echo "\n=== Tables in ugadmission2026 ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM ugadmission2026.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME;");

if ($r3 !== false) {
    while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) {
        echo $row[0]."\n";
    }
    sqlsrv_free_stmt($r3);
} else {
    echo "SQL ERROR fetching ugadmission2026 tables.\n";
    print_r(sqlsrv_errors());
}

echo "\nDONE\n";
sqlsrv_close($c);
?>
