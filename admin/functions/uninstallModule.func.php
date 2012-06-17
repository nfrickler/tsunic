<!-- | function to uninstall modules -->
<?php
function uninstallModule () {

    // get id__module
    $id__module = (isset($_GET['id']) AND is_numeric($_GET['id'])) ? $_GET['id'] : 0;
    if (empty($id__module)) return true;

    // get module-object
    include_once 'classes/ts_Module.class.php';
    $Module = new ts_Module($id__module);

    // uninstall
    if (!$Module->uninstallModule()) {
	// error
	$_SESSION['admin_error'] = 'ERROR__UNINSTALLMODULE';
	return false;
    }

    $_SESSION['admin_info'] = 'INFO__UNINSTALLMODULE';
    return true;
}
?>
