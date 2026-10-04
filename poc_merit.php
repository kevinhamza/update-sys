<?php
header("Content-Type: text/plain");
$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID"=>"sa","PWD"=>$pw,"LoginTimeout"=>8));
if (!$c) { die("FAIL\n"); }

// Enumerate tables in ugadmission
echo "\n=== data in ugadmission.web_ca_UGMeritResult ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.web_ca_UGMeritResult;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

echo "\n=== data in ugadmission.tbl_Admin_Results ===\n";
// FIXED: Changed uugadmission to ugadmission
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.tbl_Admin_Results;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

echo "\n=== data in ugadmission.tbl_Admin_ResultFileDetails ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.tbl_Admin_ResultFileDetails;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

echo "\n=== data in ugadmission.NET ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.NET;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

echo "\n=== data in ugadmission.web_ca_UGSelectionList ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.web_ca_UGSelectionList;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

echo "\n=== data in ugadmission.tbl_ca_login ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.tbl_ca_login;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

echo "\n=== data in ugadmission.tbl_ca_Candidate ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.tbl_ca_Candidate;");
if ($r2 !== false) {
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
    }
}

// Enumerate tables in ugadmission
echo "\n=== Tables in ugadmission ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM ugadmission.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
if ($r3 !== false) {
    while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";
}

echo "\n=== data in ugadmission2026.tbl_ca_tmpRegistration===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission2026.dbo.tbl_ca_tmpRegistration;");
if ($r2 !== false) {
    // FIXED: Closed out strings, loops, and statement blocks correctly
    while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
        foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } 
        echo "\n";
    }
}

echo "\n=== DBS ===\n";
$r3 = sqlsrv_query($c, "SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb') ORDER BY name;");
if ($r3 !== false) {
    while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";
}

echo "\nDONE\n";
?>
