<!-- | FUNCTION edit mailaccount -->
<?php
function $$$editMailaccount () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $id = $TSunic->Input->uint('$$$formMailaccount__id');
    $email = $TSunic->Input->post('$$$formMailaccount__email');
    $password = $TSunic->Input->postRaw('$$$formMailaccount__password');
    $name = $TSunic->Input->post('$$$formMailaccount__name');
    $description = $TSunic->Input->post('$$$formMailaccount__description');
    $host = $TSunic->Input->post('$$$formMailaccount__host');
    $port = $TSunic->Input->uint('$$$formMailaccount__port');
    $user = $TSunic->Input->post('$$$formMailaccount__user');
    $protocol = $TSunic->Input->uint('$$$formMailaccount__protocol');
    $auth = $TSunic->Input->uint('$$$formMailaccount__auth');
    $connsecurity =
	$TSunic->Input->uint('$$$formMailaccount__connsecurity');

    // get new mailaccount object
    $Mailaccount = $TSunic->get('$$$Mailaccount', $id);

    // validate input
    if (!$Mailaccount->isValidEmail($email)
	OR !$Mailaccount->isValidPassword($password)
	OR !$Mailaccount->isValidName($name)
	OR !$Mailaccount->isValidDescription($description)
    ) {
	$TSunic->Log->alert('error', '{EDITMAILACCOUNT__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // edit mailaccount
    if (!$Mailaccount->edit($email, $password, $name, $description)) {
	$TSunic->Log->alert('error', '{EDITMAILACCOUNT__ERROR}');
	$TSunic->redirect('back');
    }

    // try to set connection
    if (!$Mailaccount->setAutoConnection($host, $port, $user, $protocol, $auth, $connsecurity)) {
	$TSunic->Log->alert('error', '{EDITMAILACCOUNT__CONNERROR}');
	$TSunic->redirect('$$$showEditMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));
    }

    // success
    $TSunic->Log->alert('info', '{EDITMAILACCOUNT__SUCCESS}');
    $TSunic->redirect('$$$showMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));

    return true;
}
?>
