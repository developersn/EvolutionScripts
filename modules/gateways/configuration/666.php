<?php


if (!defined("EvolutionScript")) {
	exit("Hacking attempt...");
}

$payeer_currencies = array("USD" => "US Dollars", "EUR" => "Euro", "RUB" => "Russian ruble");
echo "<form method=\"post\" id=\"frm";
echo $r['id'];
echo "\" onsubmit=\"return submitform(this.id);\">
	<table width=\"100%\" class=\"widget-tbl\">
    	<tr>
        	<td align=\"right\" width=\"200\">API : </td>
            <td><input style=\"width:300px !important;\"  type=\"text\" name=\"account\" value=\"";
echo $r['account'];
echo "\" /></td>
        </tr>
    	<tr  style=\"display:none !important;\" >
        	<td align=\"right\">Currency:</td>
            <td><select name=\"currency\">
            	";
foreach ($payeer_currencies as $k => $v) {

	if ($k == $r['currency']) {
		echo "<option value=\"" . $k . "\" selected>" . $v . "</option>";
		continue;
	}

	echo "<option value=\"" . $k . "\">" . $v . "</option>";
}

echo "            </select>
            </td>
        </tr>
    	<tr style=\"display:none !important;\" >
        	<td align=\"right\"></td>
            <td><input type=\"text\" name=\"option1\" value=\"";
echo $r['option1'];
echo "\" /></td>
        </tr>
    	<tr style=\"display:none !important;\" >
        	<td align=\"right\">Success Url:</td>
            <td style=\"color:#000099\">";
echo $settings['site_url'];
echo "modules/gateways/</td>
        </tr>
    	<tr style=\"display:none !important;\" >
        	<td align=\"right\">Fail Url:</td>
            <td style=\"color:#000099\">";
echo $settings['site_url'];
echo "modules/gateways/</td>
        </tr>
    	<tr style=\"display:none !important;\" >
        	<td align=\"right\">Status Url:</td>
            <td style=\"color:#000099\">";
echo $settings['site_url'];
echo "modules/gateways/</td>
        </tr>
    	<tr>
        	<td align=\"right\">قابل استفاده برای ارتقا و تمدید پلن حساب کاربری؟</td>
            <td><select name=\"allow_upgrade\">
            	<option value=\"yes\" ";
echo $r['allow_upgrade'] == "yes" ? "selected" : "";
echo ">بلی</option>
                <option value=\"no\" ";
echo $r['allow_upgrade'] == "no" ? "selected" : "";
echo ">خیر</option>
            </select>
            </td>
        </tr>
    	<tr>
        	<td align=\"right\">قابل استفاده برای شارژ حساب کاربری؟</td>
            <td><select name=\"allow_deposits\">
            	<option value=\"yes\" ";
echo $r['allow_deposits'] == "yes" ? "selected" : "";
echo ">بله</option>
                <option value=\"no\" ";
echo $r['allow_deposits'] == "no" ? "selected" : "";
echo ">خیر</option>
            </select>
            </td>
        </tr>
    	<tr>
        	<td align=\"right\">کمترین مبلغ قابل پرداخت برای شارژ حساب</td>
            <td><input type=\"text\" name=\"min_deposit\" value=\"";
echo $r['min_deposit'];
echo "\" /> (توجه : پرداخت مبلغ کمتر از 100تومان از طريق پرداخت انلاين امکان پذير نمي باشد.)</td>
        </tr>
    	
        <tr>
        	<td  align=\"right\">آی پی سرور</td>
            <td style=\"color:#0000CC\">";
echo $_SERVER['SERVER_ADDR'];
echo "</td>
        </tr>




    	<tr style=\"display:none !important;\" >
        	<td align=\"right\">Note:</td>
            <td><input type=\"text\" name=\"option5\" value=\"";
echo $r['option5'];
echo "\" /> <span style=\"color:green\">(For instant withdrawals)</span></td>
        </tr>
        <tr>
        	<td></td>
            <td>
            <input type=\"hidden\" name=\"gateway_action\" value=\"\" id=\"action";
echo $r['id'];
echo "\" />
            <input type=\"hidden\" name=\"gateway_id\" value=\"";
echo $r['id'];
echo "\" />
            <input type=\"submit\" name=\"btn\" value=\"ثبت\" onclick=\"updfrmvars({'action";
echo $r['id'];
echo "': 'update'});\" />
            	<input type=\"submit\" name=\"btn\" value=\"غیرفعال سازی درگاه\" onclick=\"updfrmvars({'action";
echo $r['id'];
echo "': 'deactivate'});\" />
            </td>
        </tr>
    </table>
</form>";
?>