<html>
<head>
<title>RaspiPass configuration page</title>
<link rel="stylesheet" type="text/css" href="raspipass.css" />
<link href="tab-content/template2/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
</head>
<body>
<?php
/* Read version file and latest version from URL, and compare */
	$version=file("/raspipass/version");
	$latestversion=file("https://raw.githubusercontent.com/Pinchie/RaspiPass/master/raspipass/version");
	$newversionavailable=version_compare($version[0],$latestversion[0],'<');

/* Read config.ini */
        $config_array=parse_ini_file("/raspipass/config.ini");

/* Header Table */
	echo '<table align="center">' . "\n";
	echo '<tr>';
	echo '<th colspan="2" style="background-color: #031634"><img src="logo.png" align="center">';
	echo '</th>';
	echo '</tr>' . "\n";
	echo '<tr style="background-color:transparent">' . "\n";
	echo '<td align="center" style="color: grey" colspan="2">Version ';
	echo $version[0];
	echo '</td>';
	echo '</tr>' . "\n";

/* Notify of newer version */
if ($newversionavailable) {
	echo '<tr style="background-color:transparent">' . "\n";
	echo '<td align="center" style="color: red" colspan="2">New version available: ';
	echo $latestversion[0];
	echo '</td>' . "\n";
	echo '</tr>' . "\n";
}

/* Close header table */

	echo '</table>' . "\n";

/* Create Tabs */
	echo '<ul class="tabs" data-persist="true">' . "\n";
	echo '<li><a href="#config">Configuration</a></li>' . "\n";
	echo '<li><a href="#maclist">StreetPass MACs</a></li>' . "\n";
	echo '<li><a href="#admin">Admin Tasks</a></li>' . "\n";
	echo '<li><a href="#logs">Log Viewer</a></li>' . "\n";
if ($newversionavailable) {
	echo '<li><a href="#update" style="color:darkred">Update</a></li>' . "\n";
}
	echo '</ul>' . "\n";

/* Start Configuration Tab */
	echo '<div class="tabcontents">' . "\n";
	echo '<div id="config">' . "\n";

/* Start config table */
	echo '<table align="center">' . "\n";

/* Start form */
        echo '<form name="raspipass_config" id="raspipass_config" method="post" action="save_config.php">' . "\n";

/* Run probability header */
	echo '<tr><th colspan="3">Run Probability Configuration</th></tr>';

/* Run interval */
        echo '<tr>' . "\n";
        echo '<td>Run every:</td>' . "\n";
        echo '<td><input type="number" name="runinterval" min="6" max="60" value="' . $config_array["runinterval"] . '"> minutes [6-60]</td>' . "\n";
	echo '</tr>';

/* Run probability */
	echo '<tr>' . "\n";
	echo '<td>Run chance:</td>' . "\n";
	echo '<td><input type="number" name="runchance" min="0" max="100" value="' . $config_array["runchance"] . '">%' . "</td>\n";
        echo '</tr>' . "\n";

/* Average interval calculation */
        echo '<tr>';
        echo '<td colspan="3" align="center"><sub>Every ' . $config_array["runinterval"] . ' minutes at ' . $config_array["runchance"] . '% will raise an access point an average of ' . round(($config_array["runchance"]/100)/($config_array["runinterval"]/60),2) . ' times per hour';
        echo '</tr>' . "\n";

/* Wifi Config Header */
	echo '<tr><th colspan="3">Wireless Access Point Configuration</th></tr>';

/* Wifi Country Codes */
        echo '<td>' . "\n";
	echo 'Wireless Country:';
        echo '</td>' . "\n";
        echo '<td colspan="2">' . "\n";
	echo '<select name="Wireless_Region">';
	$wifiregions=array('AF'=>'Afghanistan','AX'=>'Åland Islands','AL'=>'Albania','DZ'=>'Algeria','AS'=>'American Samoa','AD'=>'Andorra','AO'=>'Angola','AI'=>'Anguilla','AQ'=>'Antarctica','AG'=>'Antigua and Barbuda','AR'=>'Argentina','AM'=>'Armenia','AW'=>'Aruba','AU'=>'Australia','AT'=>'Austria','AZ'=>'Azerbaijan','BS'=>'Bahamas','BH'=>'Bahrain','BD'=>'Bangladesh','BB'=>'Barbados','BY'=>'Belarus','BE'=>'Belgium','BZ'=>'Belize','BJ'=>'Benin','BM'=>'Bermuda','BT'=>'Bhutan','BO'=>'Bolivia (Plurinational State of)','BQ'=>'Bonaire, Sint Eustatius and Saba','BA'=>'Bosnia and Herzegovina','BW'=>'Botswana','BV'=>'Bouvet Island','BR'=>'Brazil','IO'=>'British Indian Ocean Territory','BN'=>'Brunei Darussalam','BG'=>'Bulgaria','BF'=>'Burkina Faso','BI'=>'Burundi','CV'=>'Cabo Verde','KH'=>'Cambodia','CM'=>'Cameroon','CA'=>'Canada','KY'=>'Cayman Islands','CF'=>'Central African Republic','TD'=>'Chad','CL'=>'Chile','CN'=>'China','CX'=>'Christmas Island','CC'=>'Cocos (Keeling) Islands','CO'=>'Colombia','KM'=>'Comoros','CG'=>'Congo','CD'=>'Congo (Democratic Republic of the)','CK'=>'Cook Islands','CR'=>'Costa Rica','CI'=>'Côte d\'Ivoire','HR'=>'Croatia','CU'=>'Cuba','CW'=>'Curaçao','CY'=>'Cyprus','CZ'=>'Czech Republic','DK'=>'Denmark','DJ'=>'Djibouti','DM'=>'Dominica','DO'=>'Dominican Republic','EC'=>'Ecuador','EG'=>'Egypt','SV'=>'El Salvador','GQ'=>'Equatorial Guinea','ER'=>'Eritrea','EE'=>'Estonia','ET'=>'Ethiopia','FK'=>'Falkland Islands (Malvinas)','FO'=>'Faroe Islands','FJ'=>'Fiji','FI'=>'Finland','FR'=>'France','GF'=>'French Guiana','PF'=>'French Polynesia','TF'=>'French Southern Territories','GA'=>'Gabon','GM'=>'Gambia','GE'=>'Georgia','DE'=>'Germany','GH'=>'Ghana','GI'=>'Gibraltar','GR'=>'Greece','GL'=>'Greenland','GD'=>'Grenada','GP'=>'Guadeloupe','GU'=>'Guam','GT'=>'Guatemala','GG'=>'Guernsey','GN'=>'Guinea','GW'=>'Guinea-Bissau','GY'=>'Guyana','HT'=>'Haiti','HM'=>'Heard Island and McDonald Islands','VA'=>'Holy See','HN'=>'Honduras','HK'=>'Hong Kong','HU'=>'Hungary','IS'=>'Iceland','IN'=>'India','ID'=>'Indonesia','IR'=>'Iran (Islamic Republic of)','IQ'=>'Iraq','IE'=>'Ireland','IM'=>'Isle of Man','IL'=>'Israel','IT'=>'Italy','JM'=>'Jamaica','JP'=>'Japan','JE'=>'Jersey','JO'=>'Jordan','KZ'=>'Kazakhstan','KE'=>'Kenya','KI'=>'Kiribati','KP'=>'Korea (Democratic People\'s Republic of)','KR'=>'Korea (Republic of)','KW'=>'Kuwait','KG'=>'Kyrgyzstan','LA'=>'Lao People\'s Democratic Republic','LV'=>'Latvia','LB'=>'Lebanon','LS'=>'Lesotho','LR'=>'Liberia','LY'=>'Libya','LI'=>'Liechtenstein','LT'=>'Lithuania','LU'=>'Luxembourg','MO'=>'Macao','MK'=>'Macedonia (the former Yugoslav Republic of)','MG'=>'Madagascar','MW'=>'Malawi','MY'=>'Malaysia','MV'=>'Maldives','ML'=>'Mali','MT'=>'Malta','MH'=>'Marshall Islands','MQ'=>'Martinique','MR'=>'Mauritania','MU'=>'Mauritius','YT'=>'Mayotte','MX'=>'Mexico','FM'=>'Micronesia (Federated States of)','MD'=>'Moldova (Republic of)','MC'=>'Monaco','MN'=>'Mongolia','ME'=>'Montenegro','MS'=>'Montserrat','MA'=>'Morocco','MZ'=>'Mozambique','MM'=>'Myanmar','NA'=>'Namibia','NR'=>'Nauru','NP'=>'Nepal','NL'=>'Netherlands','NC'=>'New Caledonia','NZ'=>'New Zealand','NI'=>'Nicaragua','NE'=>'Niger','NG'=>'Nigeria','NU'=>'Niue','NF'=>'Norfolk Island','MP'=>'Northern Mariana Islands','NO'=>'Norway','OM'=>'Oman','PK'=>'Pakistan','PW'=>'Palau','PS'=>'Palestine, State of','PA'=>'Panama','PG'=>'Papua New Guinea','PY'=>'Paraguay','PE'=>'Peru','PH'=>'Philippines','PN'=>'Pitcairn','PL'=>'Poland','PT'=>'Portugal','PR'=>'Puerto Rico','QA'=>'Qatar','RE'=>'Réunion','RO'=>'Romania','RU'=>'Russian Federation','RW'=>'Rwanda','BL'=>'Saint Barthélemy','SH'=>'Saint Helena, Ascension and Tristan da Cunha','KN'=>'Saint Kitts and Nevis','LC'=>'Saint Lucia','MF'=>'Saint Martin (French part)','PM'=>'Saint Pierre and Miquelon','VC'=>'Saint Vincent and the Grenadines','WS'=>'Samoa','SM'=>'San Marino','ST'=>'Sao Tome and Principe','SA'=>'Saudi Arabia','SN'=>'Senegal','RS'=>'Serbia','SC'=>'Seychelles','SL'=>'Sierra Leone','SG'=>'Singapore','SX'=>'Sint Maarten (Dutch part)','SK'=>'Slovakia','SI'=>'Slovenia','SB'=>'Solomon Islands','SO'=>'Somalia','ZA'=>'South Africa','GS'=>'South Georgia and the South Sandwich Islands','SS'=>'South Sudan','ES'=>'Spain','LK'=>'Sri Lanka','SD'=>'Sudan','SR'=>'Suriname','SJ'=>'Svalbard and Jan Mayen','SZ'=>'Swaziland','SE'=>'Sweden','CH'=>'Switzerland','SY'=>'Syrian Arab Republic','TW'=>'Taiwan, Province of China[a]','TJ'=>'Tajikistan','TZ'=>'Tanzania, United Republic of','TH'=>'Thailand','TL'=>'Timor-Leste','TG'=>'Togo','TK'=>'Tokelau','TO'=>'Tonga','TT'=>'Trinidad and Tobago','TN'=>'Tunisia','TR'=>'Turkey','TM'=>'Turkmenistan','TC'=>'Turks and Caicos Islands','TV'=>'Tuvalu','UG'=>'Uganda','UA'=>'Ukraine','AE'=>'United Arab Emirates','GB'=>'United Kingdom of Great Britain and Northern Ireland','US'=>'United States of America','UM'=>'United States Minor Outlying Islands','UY'=>'Uruguay','UZ'=>'Uzbekistan','VU'=>'Vanuatu','VE'=>'Venezuela (Bolivarian Republic of)','VN'=>'Viet Nam','VG'=>'Virgin Islands (British)','VI'=>'Virgin Islands (U.S.)','WF'=>'Wallis and Futuna','EH'=>'Western Sahara','YE'=>'Yemen','ZM'=>'Zambia','ZW'=>'Zimbabwe');
	foreach($wifiregions as $wifiregioncode=>$wifiregion) {
		if ($wifiregioncode==$config_array["wifi_country"]) {
			$s=' selected';
		}
		else {
			$s='';
		}
		echo '<option value="' . $wifiregioncode  . '"' . $s . '>' . $wifiregion . '</option>';
	}
	echo '</select>' . "\n";
        echo '</td>' . "\n";
        echo '</tr>' . "\n";

/* Wifi channel */
        echo '<tr>' . "\n";
        echo '<td>' . "\n";
	echo'Wireless Channel:';
        echo '</td>' . "\n";
        echo '<td colspan="2">' . "\n";
	echo '<select name="Wireless_Channel">';
	$wifichannels=array('1','2','3','4','5','6','7','8','9','10','11');
	foreach($wifichannels as $wifichannel) {
		if ($wifichannel==$config_array["wifi_channel"]) {
			$s=' selected';
		}
		else {
			$s='';
		}
		echo '<option value="' . $wifichannel . '"' . $s . '>' . $wifichannel . '</option>';
	}
	echo'</select>' . "\n";
        echo '</td>' . "\n";
        echo '</tr>' . "\n";

/* MAC restriction */
/*        echo '<tr>' . "\n";
        echo '<td>' . "\n";
	echo 'MAC Restriction:' . "\n";
        echo '</td>' . "\n";
        echo '<td colspan="2">' . "\n";
	echo '<input type="Radio" name="MAC_restrict" value="0"';
	if ($config_array["mac_restriction"]=="0") {
		echo ' checked';
	}
	echo '>Off' . "\n";
	echo '<input type="Radio" name="MAC_restrict" value="1"';
	if ($config_array["mac_restriction"]=="1") {
		echo ' checked';
	}
	echo '>On' . "\n";
        echo '</td>' . "\n";
        echo '</tr>' . "\n";
        echo '<tr>' . "\n";
        echo '<td colspan="3">' . "\n";
	echo '<Textarea name="MAC_list" cols="80" rows="10">' . "\n";
	$maclist=fopen("/raspipass/mac_restrict.txt","r");
        while (!feof($maclist)) {
                $macline = fgets($maclist);
                print $macline;
        }
        fclose($maclist);
	echo '</Textarea>' . "\n";
        echo '</td>' . "\n";
        echo '</tr>' . "\n";
*/
/* Submission Button & Form End */
        echo '<tr>' . "\n";
        echo '<td colspan="3">' . "\n";
	echo '<input type="submit" name=submit_button" id="submit_button" value="Save & Write Config" />' . "\n";
	echo '</form>' . "\n";
	echo '</td>';
	echo '</tr>';

/* Close Table */
        echo '</table>' . "\n";
        echo '<p>' . "\n";

/* Close Configuration Tab */
	echo '</div>' . "\n";

/* Open MAC Addresses Tab */
	echo '<div id="maclist">' . "\n";

/* Start MAC form */
        echo '<form name="raspipass_maclist" id="raspipass_mac_list" method="post" action="save_maclist.php">' . "\n";

/* Start MAC address table */
        echo '<table align="center">' . "\n";
	echo '<tr><th colspan="2">StreetPass Relay MACs</th></tr>';
	echo '<tr><td>The following is a list of StreetPass Relay MAC addresses.<br>The RaspiPass script will randomly choose an address from the list to use.</td></tr>';
        echo '<tr>' . "\n";
        echo '<td colspan="2">' . "\n";
        echo '<Textarea name="MAC_list" cols="80" rows="10">' . "\n";
        $maclist=fopen("/raspipass/mac_addresses.txt","r");
        while (!feof($maclist)) {
                $macline = fgets($maclist);
                print $macline;
        }
        fclose($maclist);
        echo '</Textarea>' . "\n";
        echo '</td>' . "\n";
	echo '</tr>' . "\n";

/* Submission Button & MAC Form End */
        echo '<tr>' . "\n";
        echo '<td colspan="2">' . "\n";
        echo '<input type="submit" name=submit_button" id="submit_button" value="Save MAC list" />' . "\n";
        echo '</form>' . "\n";
        echo '</td>';
        echo '</tr>';
	echo '</table>';

/* Close MAC Addresses Tab */
	echo '</div>' . "\n";

/* Open Admin Tab */
        echo '<div id="admin">' . "\n";
	echo '<table align="center" class="buttontable">' . "\n";
	echo '<tr><th colspan="3">Administrative Tasks</th></tr>';
	/* Start AP */
	echo '<tr><td class="buttoncell">';
	echo '<form name="start_ap" id="" method="post" action="start_ap.php">' . "\n";
	echo '<input type="submit" name="submit_button" id="submit_button" value="Start Access Point" />' . "\n";
	echo '</td>';
	echo '</form>' . "\n";
	/* Reboot device */
        echo '<td class="buttoncell">';
        echo '<form name="reboot_device" id="" method="post" action="reboot.php">' . "\n";
        echo '<input type="submit" name="submit_button" id="submit_button" value="Reboot device" />' . "\n";
        echo '</td>';
	echo '</form>' . "\n";
	/* Shut down device */
        echo '<td class="buttoncell">';
        echo '<form name="shutdown_device" id="" method="post" action="shutdown.php">' . "\n";
        echo '<input type="submit" name="submit_button" id="submit_button" value="Shut down device" />' . "\n";
        echo '</td></tr>';
        echo '</form>' . "\n";

	echo '</table>';

/* Close Admin Tab */
        echo '</div>' . "\n";

/* Open Logs Tab */
        echo '<div id="logs">' . "\n";

/* Open table */
        echo '<table align="center">' . "\n";
        echo '<tr><th colspan="2">Log Viewer</th></tr>';

/* Print /raspipass/log/hostapd */
        echo '<tr><td>/raspipass/log/hostapd</td></tr>';
        echo '<tr>' . "\n";
        echo '<td colspan="2">' . "\n";
        echo '<Textarea name="hostapd_log" cols="80" rows="15" readonly="readonly">' . "\n";
        $hostapd_log=fopen("/raspipass/log/hostapd","r");
        while (!feof($hostapd_log)) {
                $hostapd_log_line = fgets($hostapd_log);
                print $hostapd_log_line;
        }
        fclose($hostapd_log);
	echo '</textarea>' . "\n";
	echo '</td>' . "\n";
	echo '</table>' . "\n";

/* Close Logs Tab */
	echo '</div>' . "\n";

if ($newversionavailable) {

/* Open Update Tab */
        echo '<div id="update">' . "\n";

/* Open table */
        echo '<table align="center">' . "\n";
        echo '<tr><th colspan="2">RaspiPass Update</th></tr>';
        echo '</table>' . "\n";
	echo '<div id="admin">' . "\n";
        echo '<table align="center" class="buttontable">' . "\n";
        echo '<tr><th colspan="3">Administrative Tasks</th></tr>';

/* Update button */
        echo '<tr><td class="buttoncell">';
        echo '<form name="update" id="" method="post" action="update.php">' . "\n";
        echo '<input type="submit" name="submit_button" id="submit_button" value="Update RaspiPbass" />' . "\n";
        echo '</td>';
        echo '</form>' . "\n";

/* Close Update Tab */
        echo '</div>' . "\n";
}
/* Close Tabbed Section */
echo '</div>' . "\n";
?>
</body>
</html>
