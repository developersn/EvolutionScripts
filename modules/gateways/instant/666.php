<?php


if (!defined("EvolutionScript")) {
	exit("Hacking attempt...");
}

$payment_status = "wrong";

if ($settings['fail_payments'] == "yes") {
		$insert = array("user_id" => $user_info['id'], "method" => $gateway['id'], "account" => $usrinternalgtw[$gatewayid], "amount" => $new_amount, "fee" => $withdraw_fee, "date" => TIMENOW, "status" => "Pending");
		$withdrawid = $upd = $db->insert("withdraw_history", $insert);
		$set = array("pending_withdraw" => $user_info['pending_withdraw'] + $new_amount, "money" => $user_info['money'] - $withdraw_amount, "cashout_times" => $user_info['cashout_times'] + 1, "last_cashout" => TIMENOW);
		$db->update("members", $set, "id = " . $user_info['id']);
		$upd = $db->lastInsertId();
		serveranswer(2, "$(\"#message_sent\").show();");
	}


?>