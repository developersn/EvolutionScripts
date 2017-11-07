<?php

@session_start();
define("EvolutionScript", 1);
require_once "global.php";
$gateway = $db->fetchRow("SELECT * FROM gateways WHERE id=666");
$m_api = $gateway['account'];

if ($input->p['type'] == "deposit") {
	$upgrade = 0;
	$upgrade_id = 0;
}
else {
	$upgrade = 1;
	$upgrade_id = $db->real_escape_string($_POST['upgradeid']);
}

// Security
$sec = uniqid();
$md = md5($sec.'vm');
// Security

$_SESSION["upgrades"] = $upgrade;
$_SESSION["upgrade_ids"] = $upgrade_id;

$user_id = $db->real_escape_string($_POST['user']);
$user_info = $db->fetchRow("SELECT * FROM members WHERE id=" . $user_id);

$_SESSION["user_ids"]=$user_id;

$id = $db->lastInsertId();
$_SESSION["ids"]=$id;


$amount = $_POST['amount'];
$_SESSION["amounts"]=$amount;

$callback = "" . $settings['site_url'] . "modules/gateways/sn_verify.php?do=verify"."&md=".$md."&sec=".$sec;
$resnum=time();
$_SESSION["resnum"]=$resnum;

$data_string = json_encode(array(
'pin'=> $m_api,
'price'=> $amount/10,
'callback'=> $callback ,
'order_id'=> $resnum,
'ip'=> $_SERVER['REMOTE_ADDR'],
'callback_type'=>2
));

$ch = curl_init('https://developerapi.net/api/v1/request');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
$result = curl_exec($ch);
curl_close($ch);


$json = json_decode($result,true);
if ($json['result'] AND$json['result']==1)
	{
// Set Session
$_SESSION[$sec] = [
	'price'=>$amount/10 ,
	'order_id'=>$resnum ,
	'au'=>$json['au'] ,
];
					echo ('<div style="display:none">'.$json['form'].'</div>Please wait ... <script language="javascript">document.payment.submit(); </script>');

	}
	else
	{
		echo 'Error '.$json['msg'];
	}

?>
