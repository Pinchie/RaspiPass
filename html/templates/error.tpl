{include file='header_common.tpl'}
<table align="center">
<tr><th colspan="2" style="background-color: #031634"><img src="logo.png" align="center"></th></tr>
</table>
<br>
<table align="center">
<tr><td>Error log:</td></tr>
<tr><td>
<Textarea name="error_log" cols="80" rows="15" readonly="readonly">
{foreach from=$errorlist item=errorline}
{$errorline}
{/foreach}
{*$errorlist|@print_r*}
</textarea>
</td></tr></table>
{include file='footer_common.tpl'}
