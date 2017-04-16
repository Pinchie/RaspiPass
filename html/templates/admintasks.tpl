{include file='header_common.tpl'}
<table align="center" class="buttontable">
<tr><th colspan="3">Timezone/Locale Config</th></tr>
{if $rebootmsg}
<tr><td><font color="red"><b>Reboot pending: {$rebootmsg}</b></font></td></tr>
{/if}
<tr><td class="buttoncell"><form name="locale_config" id="locale_config" method="post" action="set_locale.php" autocomplete="off" target="_parent">
{html_options name=Locale options=$locales selected=$currentlocale}
<input type="submit" name="submit_button" id="submit_button" value="Set Locale" />
</tr></td></form>
<tr><th colspan="3">Administrative Tasks</th></tr>
<tr><td class="buttoncell"><form name="start_ap" id="" method="post" action="start_ap.php" target="_parent">
<input type="submit" name="submit_button" id="submit_button" value="Start Access Point" />
</td></form>
<td class="buttoncell"><form name="reboot_device" id="" method="post" action="reboot.php" target="_parent">
<input type="submit" name="submit_button" id="submit_button" value="Reboot device" />
</td></form>
<td class="buttoncell"><form name="shutdown_device" id="" method="post" action="shutdown.php" target="_parent">
<input type="submit" name="submit_button" id="submit_button" value="Shut down device" />
</td></tr></form>
</table></div>
{include file='footer_common.tpl'}
