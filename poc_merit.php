<?php
header("Content-Type: text/plain");

$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID" => "sa", "PWD" => $pw, "LoginTimeout" => 8));

if (!$c) { 
    die("FAIL: Connection could not be established.\n"); 
}

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
    
    if ($r2 === false) {
        echo "ERROR: Failed to execute query for table {$table}\n";
        continue;
    }
    while ($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        echo implode("\t| ", $row) . "\n";
    }
    
    sqlsrv_free_stmt($r2);
}

echo "\n=== Tables in pgadmission2026 ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM ugadmission2026.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME;");

if ($r3 !== false) {
    while ($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) {
        echo $row[0] . "\n";
    }
    sqlsrv_free_stmt($r3);
} else {
    echo "ERROR: Could not fetch tables from ugadmission2026.\n";
}

echo "\nDONE\n";
sqlsrv_close($c);
?>
