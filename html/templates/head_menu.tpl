{include file='header_common.tpl'}
<table class="menutable">
<tr>
<td><a href="config.php" target="main_body"><img src="buttons/button_configuration.png"></a></td>
<td><a href="maclist.php" target="main_body"><img src="buttons/button_streetpass-aps.png"></a></td>
{if $rebootmsg}
<td><a href="admintasks.php" target="main_body"><img src="buttons/button_administration-alert.png"></a></td>
{else}
<td><a href="admintasks.php" target="main_body"><img src="buttons/button_administration.png" class="menubutton"></a></td>
{/if}
<td><a href="logviewer.php" target="main_body"><img src="buttons/button_log-viewer.png"></a></td>
{if $newversionavailable}
<td><a href="update.php" target="main_body"><img src="buttons/button_update.png"></a></td>
{/if}
</tr>
</table>
{include file='footer_common.tpl'}