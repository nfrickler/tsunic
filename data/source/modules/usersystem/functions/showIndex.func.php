<!-- | function to show main page -->
<?php
function $$$showIndex () {
    global $TSunic;

    // activate template
    $data = array('User' => $TSunic->Usr);
    $TSunic->Tmpl->activate('$$$showIndex', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

    return true;
}
?>
