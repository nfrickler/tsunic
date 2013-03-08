<!-- | FUNCTION show page to confirm profile deletion -->
<?php
function $$$showDeleteProfile () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Profile object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // activate template
    $data = array('Profile' => $Profile);
    $TSunic->Tmpl->activate('$$$showDeleteProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEPROFILE__TITLE}'));

    return true;
}
?>
