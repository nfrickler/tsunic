<!-- | FUNCTION show MyProfile -->
<?php
function $$$showMyProfile () {
    global $TSunic;

    // get MyProfile object
    $Meta = $TSunic->get('$$$Meta');
    $MyProfile = $Meta->getMyProfile();
    if (!$MyProfile) {
	$MyProfile = $TSunic->get('$$$MyProfile');
	$MyProfile->create();
	$MyProfile->saveByTag('PROFILE__ACCOUNT', $TSunic->Usr->getInfo('id'));
	$MyProfile->shareWith_all(array($TSunic->Usr->getIdGuest() => 0));
    }

    // redirect to showProfile
    $TSunic->redirect('$$$showProfile', array(
	'$$$id' => $MyProfile->getInfo('id')
    ));

    return true;
}
?>
