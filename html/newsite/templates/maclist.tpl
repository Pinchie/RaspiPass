{include file='header_common.tpl'}
<form name="raspipass_maclist" id="raspipass_mac_list" method="post" action="save_maclist.php" target="_parent">
<table align="center">
<tr><th colspan="2">StreetPass Relay APs</th></tr><tr><td>The following is a list of StreetPass Relay SSIDs & MAC addresses.<br>
The RaspiPass script will randomly choose an access point from the list to use.<br>
The access points are saved in the format "SSID,MAC address"</td></tr>
<tr>
<td colspan="2">
<Textarea name="MAC_list" cols="80" rows="10">
{foreach from=$maclist item=macline}
{$macline|strip}
{/foreach}</Textarea>
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name=submit_button" id="submit_button" value="Save MAC list" />
</form>
</td></tr></table></div>
{include file='footer_common.tpl'}