<!-- | FUNCTION add new mail account -->
<?php
function $$$addMailaccount () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $email = $TSunic->Input->post('$$$formMailaccount__email');
    $password = $TSunic->Input->postRaw('$$$formMailaccount__password');
    $name = $TSunic->Input->post('$$$formMailaccount__name');
    $description = $TSunic->Input->post('$$$formMailaccount__description');
    $host = $TSunic->Input->post('$$$formMailaccount__host');
    $port = $TSunic->Input->post('$$$formMailaccount__port');
    $user = $TSunic->Input->post('$$$formMailaccount__user');
    $protocol = $TSunic->Input->post('$$$formMailaccount__protocol');
    $auth = $TSunic->Input->post('$$$formMailaccount__auth');
    $connsecurity = $TSunic->Input->post('$$$formMailaccount__connsecurity');

    // get new mailaccount object
    $Mailaccount = $TSunic->get('$$$Mailaccount');

    // validate input
    if (!$Mailaccount->isValidEmail($email)
	OR !$Mailaccount->isValidPassword($password)
	OR !$Mailaccount->isValidName($name)
	OR !$Mailaccount->isValidDescription($description)
    ) {
	$TSunic->Log->alert('error', '{ADDMAILACCOUNT__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // create account
    if (!$Mailaccount->create($email, $password, $name, $description)) {
	$TSunic->Log->alert('error', '{ADDMAILACCOUNT__ERROR}');
	$TSunic->redirect('back');
    }

    // try to set connection
    if (!$Mailaccount->setAutoConnection($host, $port, $user, $protocol, $auth, $connsecurity)) {
	$TSunic->Log->alert('error', '{ADDMAILACCOUNT__CONNERROR}');
	$TSunic->redirect('$$$showEditMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));
    }

    // success
    $TSunic->Log->alert('info', '{ADDMAILACCOUNT__SUCCESS}');
    $TSunic->redirect('$$$showMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));

    return true;
}
?>
