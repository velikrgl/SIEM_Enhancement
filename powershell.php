

<pre>
<?php

//ip blok list rule

echo shell_exec('if( (-not (Get-NetFirewallRule -DisplayName "blokListIP")) { 
    $ips = (Get-NetFirewallRule -DisplayName "blokListIP" | Get-NetFirewallAddressFilter ).RemoteAddress
    $ips += ",123.123.1.123"
    Set-NetFirewallRule -DisplayName "blokListIP" -RemoteAddress $ips
    } else {
    New-NetFirewallRule -DisplayName "blokListIP" -Direction Outbound –LocalPort Any -Protocol TCP -Action Block -RemoteAddress 123.123.123.123
    }');

    
?>
</pre>