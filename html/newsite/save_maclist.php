<?php
/* Save variable*/
	$MAC_list=$_POST['MAC_list'];
	$MAC_list = str_replace("\r","",$MAC_list);

/* Write MAC address list */
        echo 'Writing Streetpass Relay MAC list ... ';
        file_put_contents("/raspipass/mac_addresses.txt","");
		$mac_whitelist=fopen("/raspipass/mac_addresses.txt","a");
        fwrite($mac_whitelist,$MAC_list);
        fclose($mac_whitelist);
        echo "Done!\n";

/* Go back to index.php */
        echo 'Loading configuration page ...';
        header('Location: index.php');
?>
