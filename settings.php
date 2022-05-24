<?php

$server_url = "http://webwallet.com./";  // ENTER WEBSITE URL ALONG WITH A TRAILING SLASH

//MySQL 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "";

// coin rpc details
$rpc_host = "localhost";
$rpc_port = "44553";
$rpc_user = "pivxuser";
$rpc_pass = "hoox7iequeweeKeeti0";

$fullname = "Crytocurrency"; //Website Title (Do Not include 'wallet')
$short = "PIVX"; //Coin Short (BTC)
$blockchain_tx_url = "https://pivx.flitswallet.app/tx/"; //Blockchain Url 
$support = "admin@webwallet.com"; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = ""; //Donation Address - optional 

$reserve = "0"; //This fee acts as a reserve. The users balance will display as the balance in the daemon minus the reserve. We don't reccomend setting this more than the Fee the daemon charges.

//Recaptcha  v2
$recaptcha_enable = false;  // change this to true, to eanble recaptcha or false to disable recaptcha
//Recaptcha Public key 
$public = "";
//Recaptcha Private key
$secret = "";
