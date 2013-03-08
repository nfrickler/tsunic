<!-- | FUNCTION show profile -->
<?php
function $$$showProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);
    $Date = $TSunic->get('$calendar$Date', $Profile->getInfo('dateofbirth'));

    // is MyProfile?
    if ($Profile->getInfo('class') == '$$$MyProfile') {
	// redirect to showMyProfile
	$TSunic->redirect('$$$showMyProfile',
	    array('$$$id' => $Profile->getInfo('id'))
	);
    }

    // permission?
    if (!$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // activate template
    $data = array(
	'Profile' => $Profile,
	'Date' => $Date,
	'showDelete' => true,
	'h1' => '{SHOWPROFILE__H1}',
	'infotext' => '',
    );
    $TSunic->Tmpl->activate('$$$showProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILE__TITLE}'));

    return true;
}
?>
