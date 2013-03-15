<!-- | FUNCTION show MyProfile -->
<?php
function $$$showMyProfile () {
    global $TSunic;

    // get MyProfile object
    $Meta = $TSunic->get('$$$Meta');
    $MyProfile = $Meta->getMyProfile();

    // redirect to showProfile
    $TSunic->redirect('$$$showProfile', array(
	'$$$id' => $MyProfile->getInfo('id')
    ));

    return true;
}
?>
