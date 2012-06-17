<!-- | FUNCTION show information about installed modules -->
<?php
function $$$showSysteminfo () {
    global $TSunic;

    // activate template
    $data = array('modules' => $TSunic->getModules());
    $TSunic->Tmpl->activate('$$$showSysteminfo', '$$$content', $data);
    $TSunic->Tmpl->activate('$$$html', false, array('title' => '{SYSTEMINFO__TITLE}'));

    return true;
}
?>
