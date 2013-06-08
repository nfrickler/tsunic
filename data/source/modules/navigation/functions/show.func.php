<!-- | -->
<?php
function $$$show () {
    global $TSunic;

    // try to run showSystemNavigation-function of module
    $return = $TSunic->run($TSunic->Input->module().'___showSystemNavigation', false, true);

    // check, if navigation exists
    $TSunic->Tmpl->activate($TSunic->Input->module().'___system_navigation', '$$$show');

    return true;
}
?>
