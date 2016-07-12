<?php
/* Set Variables */
$wireless_region=$_POST['Wireless_Region'];
$wireless_channel=$_POST['Wireless_Channel'];
/*
$MAC_restrict=$_POST['MAC_restrict'];
$MAC_list=$_POST['MAC_list'];
*/
$runchance=$_POST['runchance'];
$runinterval=$_POST['runinterval'];

/* Write hostapd.conf */
	echo 'Saving hostapd.conf ... ';
	file_put_contents("/raspipass/hostapd.conf","");
	$hostapd = fopen("/raspipass/hostapd.conf","a");
        fwrite($hostapd,'# This file contains the options specific to the access point.' . "\n");
        fwrite($hostapd,'# Please edit the device configuration via web management rather than this tool' . "\n");
        fwrite($hostapd,'### Interface options ###' . "\n");
        fwrite($hostapd,'interface=wlan0' . "\n");
        fwrite($hostapd,'bridge=br0' . "\n");
        fwrite($hostapd,'### Options set via web config' . "\n");
        fwrite($hostapd,'channel=' . "$wireless_channel" . "\n");
        fwrite($hostapd,'country_code=' . "$wireless_region" . "\n");
/*	if ($MAC_restrict=="1") {
		fwrite($hostapd,'macaddr_acl=' . "$MAC_restrict" . "\n");
        	fwrite($hostapd,'accept_mac_file=/raspipass/mac_restrict.txt' . "\n");
	}
	else {
		fwrite($hostapd,'#macaddr_acl=' . "$MAC_restrict" . "\n");
                fwrite($hostapd,'#accept_mac_file=/raspipass/mac_restrict.txt' . "\n");
        }
*/
        fwrite($hostapd,'### Leave everything below as standard' . "\n");
        fwrite($hostapd,'wpa=0' . "\n");
        fwrite($hostapd,'hw_mode=g' . "\n");
        fwrite($hostapd,'ssid=attwifi' . "\n");
	fclose($hostapd);
	echo 'Done!' . "\n";

/* Write MAC restriction list */
/*	echo 'Writing MAC whitelist ... ';
	$MAC_list=str_replace("\r","",$MAC_list);
	file_put_contents("/raspipass/mac_restrict.txt","");
	$mac_whitelist=fopen("/raspipass/mac_restrict.txt","a");
	fwrite($mac_whitelist,$MAC_list);
	fclose($mac_whitelist);
	echo "Done!" . "\n";*/
/* Write runchance.txt */
	echo 'Writing runchance.text ... ';
	file_put_contents("/raspipass/runchance.txt","");
	$rcfile=fopen("/raspipass/runchance.txt","a");
	fwrite($rcfile,'# RaspiPass probability file' . "\n");
	fwrite($rcfile,'# This determines the chance of the access point being' . "\n");
	fwrite($rcfile,'# raisd when the script runs.' . "\n");
	fwrite($rcfile,'# This is best edited via the web configuration.' . "\n");
	fwrite($rcfile,'probability=' . $runchance . "\n");
	fclose($rcfile);
	echo "Done!" . "\n";

/* Write crontab */
	echo "Writing crontab ... ";
	file_put_contents("/raspipass/crontab.txt","");
	$crontab=fopen("/raspipass/crontab.txt","a");
	fwrite($crontab,'MAILTO=""' . "\n");
	fwrite($crontab,'# Edit this file to introduce tasks to be run by cron.' . "\n");
	fwrite($crontab,'#' . "\n");
	fwrite($crontab,'# m h  dom mon dow   command' . "\n");
	fwrite($crontab,'*/' . $runinterval . ' * * * * /raspi_secure/raspipass > /raspipass/log/hostapd' . "\n");
	fclose($crontab);
	exec('sudo crontab -u root /raspipass/crontab.txt');
	unlink("/raspipass/crontab.txt");
	echo "Done!" . "\n";

/* Write config.ini */
	echo 'Writing config.ini ... ';
	file_put_contents("/raspipass/config.ini","");
	$inifile=fopen("/raspipass/config.ini","a");
	fwrite($inifile,'; RaspiPass configuration file for web frontend' . "\n");
	fwrite($inifile,'; Edit this config via the web interface' . "\n");
	fwrite($inifile,'');
	fwrite($inifile,'[hostapd_config]' . "\n");
	fwrite($inifile,'wifi_country="' . $wireless_region . '"' . "\n");
	fwrite($inifile,'wifi_channel="' . $wireless_channel . '"' . "\n");
/*
	fwrite($inifile,'mac_restriction="' . $MAC_restrict . '"' . "\n");
*/
	fwrite($inifile,'mac_restriction=0' . "\n");
	fwrite($inifile,'runchance="' . $runchance . '"' . "\n");
	fwrite($inifile,'runinterval="' . $runinterval . '"' . "\n");
	fclose($inifile);
	echo "Done!\n";

/* Go back to index.php */
	echo 'Loading configuration page ...';
	header('Location: index.php');
?>
