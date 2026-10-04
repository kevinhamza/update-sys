<?php
header("Content-Type: text/plain");
$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID"=>"sa","PWD"=>$pw,"LoginTimeout"=>8));
if (!$c) { die("FAIL\n"); }

// Enumerate tables in ugadmission
echo "\n=== data in ugadmission.web_ca_UGMeritResult ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.web_ca_UGMeritResult;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

echo "\n=== data in ugadmission.tbl_Admin_Results ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM uugadmission.dbo.tbl_Admin_Results;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

echo "\n=== data in ugadmission.tbl_Admin_ResultFileDetails ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.tbl_Admin_ResultFileDetails;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

echo "\n=== data in ugadmission.NET ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.NET;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

echo "\n=== data in ugadmission.web_ca_UGSelectionList ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.web_ca_UGSelectionList;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

echo "\n=== data in ugadmission.tbl_ca_login ===\n";
$r2 = sqlsrv_query($c, "SELECT * FROM ugadmission.dbo.tbl_ca_login;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

echo "\n=== data in ugadmission.tbl_ca_Candidate ===\n";
$r2 = sqlsrv_query($c, "SELECT TOP 50 * FROM ugadmission.dbo.tbl_ca_Candidate;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "\n";
}

// Enumerate tables in ugadmission2026
echo "\n=== Tables in ugadmission ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM ugadmission.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";

 
echo "\n=== data in ugadmission2026.tbl_ca_tmpRegistration===\n";
$r2 = sqlsrv_query($c, "SELECT * FROM ugadmission2026.dbo.tbl_ca_tmpRegistration;");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) {
    foreach($row as $val) { echo ($val instanceof DateTime ? $val->format('Y-m-d H:i:s') : $val) . " | "; } echo "


echo "\n=== DBS ===\n";
$r3 = sqlsrv_query($c, "SELECT name, create_date FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb');");
while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";

echo "\nDONE\n";
?>
