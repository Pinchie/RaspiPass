{include file='header_common.tpl'}
<table align="center">
<form name="raspipass_config" id="raspipass_config" method="post" action="save_config.php" autocomplete="off" target="_parent">
<tr><th colspan="3">Run Probability Configuration</th></tr><tr>
<td>Run every:</td>
<td><input type="number" name="runinterval" min="6" max="60" value="{$config_array.runinterval}"> minutes [6-60]</td>
</tr><tr>
<td>Run chance:</td>
<td><input type="number" name="runchance" min="0" max="100" value="{$config_array.runchance}">%</td>
</tr>
<tr><td colspan="3" align="center"><sub>Every 6 minutes at 20% will raise an access point an average of {$runsperhour} times per hour</tr>
<tr><th colspan="3">Wireless Access Point Configuration</th></tr><td>
Wireless Region:</td>
<td colspan="2">
{html_options name=Wireless_Region options=$wificountries selected=$config_array.wifi_country}
</td>
</tr>
<tr>
<td>
Wireless Channel:</td>
<td colspan="2">
{html_options name=Wireless_Channel options=$wifichannels selected=$config_array.wifi_channel}
</td>
</tr>
<tr>
<td colspan="3">
<input type="submit" name=submit_button" id="submit_button" value="Save & Write Config" />
</form>
</td></tr></table>
<p>
{include file='footer_common.tpl'}
