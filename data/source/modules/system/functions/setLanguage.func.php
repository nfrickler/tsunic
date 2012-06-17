<!-- | FUNCTION set language -->
<?php
function $$$setLanguage () {
    global $TSunic;

    // get language
    $lang = $TSunic->Temp->getParameter('lang');

    // set language in config
    $TSunic->Usr->setConfig('$$$language', $lang);

    // redirect back
    $TSunic->redirect('back');
    return true;
}
?>
