<!-- | function to activate/deactivate styles -->
<?php
function setStyles () {
    global $Database;
    global $Config;

    // get styleHandler-object
    $StyleHandler = new ts_StyleHandler();

    // allow only, if logged in
    if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
	return false;

    // get input
    $styles_activated = array();
    foreach ($_POST as $index => $value) {
	if (substr($index, 0, 7) != 'style__') continue;
	$styles_activated[] = substr($index, 7);
    }

    // get objects of all styles
    $styles_all = $StyleHandler->getStyles();

    // activate or deactivate modules
    foreach ($styles_all as $index => $Value) {
	$new_status = (in_array($Value->getInfo('id__style'), $styles_activated)) ? true : false;
	if (!$Value->activate($new_status)) return false;
    }

    // update installation progress
    if ($Config->get('installation') < 100) {
	$Config->setArray('installation_progress', 'setStyles', true);
    }

    $_SESSION['admin_info'] = 'INFO__SETSTYLES_SUCCESS';
    return true;
}
?>
