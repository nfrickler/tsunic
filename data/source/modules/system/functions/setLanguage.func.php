<!-- | FUNCTION set language -->
<?php
function $$$setLanguage () {
    global $TSunic;

    // get language
    $lang = $TSunic->Input->param('lang');

    // set language in config
    $TSunic->Usr->setConfig('$$$language', $lang);

    // redirect back
    $TSunic->redirect('back');
    return true;
}
?>
