<?php
// Security
@session_start();
$sec=$_GET['sec'];
$mdback = md5($sec.'vm');
$mdurl=$_GET['md'];
// Security
$transData = $_SESSION[$sec];


define("EvolutionScript", 1);
require_once "global.php";
$gateway = $db->fetchRow("SELECT * FROM gateways WHERE id=666");

$m_api = $gateway['account'];
$id = $_SESSION["ids"];
$amount=$transData['price']; //
$au=$transData['au']; //
$resnum = $_SESSION["resnum"];
$batch = $au;

$order_id=$transData['order_id']; //
$upgrade = $_SESSION["upgrades"];
$upgrade_id = $_SESSION["upgrade_ids"];
$today = TIMENOW;
$resnumok=$m_api.$amount;
if (isset($_REQUEST['do'])&&$_REQUEST['do']=='verify' && isset($_GET['sec']) or isset($_GET['md']) AND $mdback == $mdurl)
{

// CallBack
$bank_return = $_POST + $_GET ;
$data_string = json_encode(array (
'pin' => $m_api,
'price' => $amount/10,
'order_id' => $resnum,
'au' => $au,
'bank_return' =>$bank_return,
));

$ch = curl_init('https://developerapi.net/api/v1/verify');
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

if (!empty($json['result']) AND $json['result']==1){

		$customer = $resnum;

		if (is_numeric($upgrade_id)) {
	        include GATEWAYS . "process_upgrade.php";
	        header("location:" . $settings['site_url'] . "index.php?view=account&page=thankyou&type=upgrade");
                exit();
		}
		
                else {		
		include GATEWAYS . "process_deposit.php";
	        header("location:" . $settings['site_url'] . "index.php?view=account&page=thankyou&type=funds");
                exit();
                }
}

else {

if (is_numeric($upgrade_id)) {
header("location:" . $settings['site_url'] . "index.php?view=account&page=upgrade");
exit();} 

else  {
header("location: " . $settings['site_url'] . "index.php?view=account&page=addfunds");
exit();}

}
}
else {
if (is_numeric($upgrade_id)) {
header("location:" . $settings['site_url'] . "index.php?view=account&page=upgrade");
exit();} 

else  {
header("location: " . $settings['site_url'] . "index.php?view=account&page=addfunds");
exit();}
}
?>