<!-- | function to initialize database -->
<?php
function initDatabase () {
    global $Database, $Config;

    // allow changes only, if logged in
    if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
	return false;

    // is already initialized?
    if ($Database->isTable('#__modules') AND $Database->isTable('#__styles')) return true;

    // init database
    $path = 'data/install.sql';
    if ($Database->runFile($path) === false) {
	$_SESSION['admin_error'] = 'ERROR__INITDATABASE';
    } else {
	$_SESSION['admin_info'] = 'INFO__INITDATABASE';
    }

    return true;
}
?>
