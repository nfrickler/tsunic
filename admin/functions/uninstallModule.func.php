<!-- | function to uninstall modules -->
<?php
function uninstallModule () {
    global $Config, $Parser;

    // get Parser object
    $ModuleHandler = new ts_ModuleHandler();
    $modules_all = $ModuleHandler->getModules(true);
    $Parser = new ts_Parser($Config->get('prefix'), $modules_all, $Config->get('debug_mode'));

    // get id__module
    $id__module = (isset($_GET['id']) AND is_numeric($_GET['id'])) ? $_GET['id'] : 0;
    if (empty($id__module)) return true;

    // get module-object
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
