<?php
// 1. FORCE PHP TO EMIT DETAILED OUTPUT INSTEAD OF A SILENT 500 BLANK PAGE
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: text/plain");

$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID"=>"sa","PWD"=>$pw,"LoginTimeout"=>8));
if (!$c) { die("FAIL: Connection breakdown\n"); }

// Array of tables to process safely from ugadmission
$ug_tables = [
    "web_ca_UGMeritResult",
    "tbl_Admin_Results",
    "tbl_Admin_ResultFileDetails",
    "NET",
    "web_ca_UGSelectionList",
    "tbl_ca_login",
    "tbl_ca_Candidate"
];

foreach ($ug_tables as $table) {
    echo "\n=== data in ugadmission.{$table} ===\n";
    $r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.{$table};");
    
    if ($r2 !== false) {
        while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
            foreach($row as $val) {
                if ($val instanceof DateTime) {
                    echo $val->format('Y-m-d H:i:s') . " | ";
                } elseif (is_resource($val)) { 
                    // Prevents crash on image/binary blobs by displaying a placeholder
                    echo "[BINARY_BLOB] | ";
                } else {
                    // Forces safe string output conversion
                    echo (string)$val . " | ";
                }
            } 
            echo "\n";
        }
        sqlsrv_free_stmt($r2);
    } else {
        echo "[Table skipped or does not exist]\n";
    }
}

// Enumerate structural names
echo "\n=== Tables in ugadmission ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM ugadmission.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
if ($r3 !== false) {
    while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) {
        echo $row[0]."\n";
    }
    sqlsrv_free_stmt($r3);
}

echo "\n=== data in ugadmission2026.tbl_ca_tmpRegistration===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission2026.dbo.tbl_ca_tmpRegistration;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) {
            if ($val instanceof DateTime) {
                echo $val->format('Y-m-d H:i:s') . " | ";
            } elseif (is_resource($val)) {
                echo "[BINARY_BLOB] | ";
            } else {
                echo (string)$val . " | ";
            }
        } 
        echo "\n";
    }
    sqlsrv_free_stmt($r2);
}

echo "\n=== DBS ===\n";
$r3 = sqlsrv_query($c, "SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb') ORDER BY name;");
if ($r3 !== false) {
    while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) {
        echo $row[0]."\n";
    }
    sqlsrv_free_stmt($r3);
}

echo "\nDONE\n";
sqlsrv_close($c);
?>
