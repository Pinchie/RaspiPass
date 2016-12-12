<html>
<head>
<title>RaspiPass configuration page</title>
<link rel="stylesheet" type="text/css" href="raspipass.css" />
</head>
<body>
<?php

/* Header Table */
	echo '<table align="center">' . "\n";
	echo '<tr>';
	echo '<th colspan="2" style="background-color: #031634"><img src="logo.png" align="center">';
	echo '</th>';
	echo '</tr>' . "\n";
	echo '</table>' . "\n";
	echo '<br>' . "\n";

/* Start error form */
	echo '<table align="center">' . "\n";
        echo '<tr><td>Error log:</td></tr>' . "\n";;
	echo '<td>' . "\n";
        echo '<Textarea name="error_log" cols="80" rows="15" readonly="readonly">' . "\n";
	if (file_exists('/var/raspipass/web-error.log')) {
	        $errorlist=fopen("/var/raspipass/web-error.log","r");
	        while (!feof($errorlist)) {
	                $errorline = fgets($errorlist);
	                print $errorline;
	        }
	        fclose($errorlist);
	}
	else {
		echo 'DOUBLE-DOWN ERROR: Could not read error from file' . "\n";
	}
	echo '</Textarea>' . "\n";
	echo '</td></tr></table>' . "\n";


?>
</body>
</html>
