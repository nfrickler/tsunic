<!-- | FUNCTION show index -->
<?php
function $$$showIndex () {
    global $TSunic;

    // get all profiles
    $Helper = $TSunic->get('$bp$Helper');
    $profiles = $Helper->getObjects('$$$Profile');

    // activate template
    $data = array('profiles' => $profiles);
    $TSunic->Tmpl->activate('$$$showIndex', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

    return true;
}
?>
