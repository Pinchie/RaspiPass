<?php
// Set up redirection on error
function errordirect($errormsg) {
        $errorlog=fopen("/var/raspipass/web-error.log","w");
        fwrite($errorlog, $errormsg);
        fclose($errorlog);
        header('Location: error.php');
}
?>
