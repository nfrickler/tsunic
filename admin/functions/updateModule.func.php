<!-- | functino to update modules -->
<?php
function updateModule () {

    // get id__module
    $id__module = (isset($_GET['id']) AND is_numeric($_GET['id'])) ? $_GET['id'] : 0;
    if (empty($id__module)) return true;

    // get module-object
    include_once 'classes/ts_Module.class.php';
    $Module = new ts_Module($id__module);

    // update
    if (!$Module->updateModule()) {
	// error
	$_SESSION['admin_error'] = 'ERROR__UPDATEMODULE';
	return false;
    }

    $_SESSION['admin_info'] = 'INFO__UPDATEMODULE';
    return true;
}
?>
