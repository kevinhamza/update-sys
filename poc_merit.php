<?php
header("Content-Type: text/plain");
$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID"=>"sa","PWD"=>$pw,"LoginTimeout"=>8));
if (!$c) { die("FAIL\n"); }

// Enumerate tables in ugadmission
echo "\n=== Tables in ugadmission2025 ===\n";
$r2 = sqlsrv_query($c, "SELECT TABLE_NAME, TABLE_TYPE FROM ugadmission2025.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) echo $row[0]." (".$row[1].")\n";

// Enumerate tables in pgadmission2026
echo "\n=== Tables in pgadmission2026 ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM ugadmission2025.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";

echo "\nDONE\n";
?>
