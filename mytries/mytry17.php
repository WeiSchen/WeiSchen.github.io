<?php
if (!isset ($_SERVER['PHP_AUTH_USER'])) {
	header( ' WWW Authenticate: Basic realm="connexion"');
	header( ' HTTP/1.1 401 Unauthorized');
	echo " Authentification requise ";
	exit ;
} else {
	// vérification du pass
	echo "<p>login : {$_SERVER['PHP_AUTH_USER']}</p>";
	echo "<p>password : {$_SERVER['PHP_AUTH_PW']}</p>";
}
?>
