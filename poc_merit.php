<?php
header("Content-Type: text/plain");
$pw = 'S$u!p3e0rStar';
$c = sqlsrv_connect("10.250.8.130", array("UID"=>"sa","PWD"=>$pw,"LoginTimeout"=>8));
if (!$c) { die("FAIL\n"); }

// List all databases with "admission" in name
echo "=== Admission Databases ===\n";
$r = sqlsrv_query($c, "SELECT name FROM sys.databases WHERE name LIKE '%admission%' OR name LIKE '%merit%' ORDER BY name");
while($row = sqlsrv_fetch_array($r, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";

// Enumerate tables in ugadmission
echo "\n=== Tables in ugadmission ===\n";
$r2 = sqlsrv_query($c, "SELECT TABLE_NAME, TABLE_TYPE FROM ugadmission.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
while($row = sqlsrv_fetch_array($r2, SQLSRV_FETCH_NUMERIC)) echo $row[0]." (".$row[1].")\n";

// Enumerate tables in pgadmission2026
echo "\n=== Tables in pgadmission2026 ===\n";
$r3 = sqlsrv_query($c, "SELECT TABLE_NAME FROM pgadmission2026.INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME");
while($row = sqlsrv_fetch_array($r3, SQLSRV_FETCH_NUMERIC)) echo $row[0]."\n";

// Enumerate tables in NAMS (via .60 linked server)
echo "\n=== Tables in NAMS (via linked server .60) ===\n";
$r4 = sqlsrv_query($c, "EXEC xp_cmdshell 'sqlcmd -S 10.250.8.60 -U sa -P \"S\$u!p3e0rStar\" -d NAMS -Q \"SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME\" -h-1 -w 200 2>&1'");
while($row = sqlsrv_fetch_array($r4, SQLSRV_FETCH_NUMERIC)) echo ($row[0]??"")."\n";

echo "\nDONE\n";
?>
