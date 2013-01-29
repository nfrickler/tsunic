<!-- | FUNCTION show profile -->
<?php
function $$$showProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);
    $Date = $TSunic->get('$calendar$Date', $Profile->getInfo('dateofbirth'));

    // activate template
    $data = array(
	'Profile' => $Profile,
	'Date' => $Date
    );
    $TSunic->Tmpl->activate('$$$showProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILE__TITLE}'));

    return true;
}
?>
