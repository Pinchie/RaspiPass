{include file='header_common.tpl'}
<table align="center">
<tr><th colspan="2">Log Viewer</th></tr><tr><td>/var/raspipass/hostapd.log</td></tr><tr>
<td colspan="2">
<Textarea name="hostapd_log" cols="80" rows="15" readonly="readonly">
{foreach from=$logcontents item=logline}
{$logline|strip}
{/foreach}</Textarea>
</textarea>
</td>
</table>
{include file='footer_common.tpl'}
