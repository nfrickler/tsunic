<!-- | FUNCTION add new Smtp -->
<?php
function $$$addSmtp () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $fk_mailaccount = $TSunic->Input->param('$$$formSmtp__fk_mailaccount');
    $email = $TSunic->Input->param('$$$formSmtp__email');
    $password = $TSunic->Input->paramRaw('$$$formSmtp__password');
    $emailname = $TSunic->Input->param('$$$formSmtp__emailname');
    $description = $TSunic->Input->param('$$$formSmtp__description');
    $host = $TSunic->Input->param('$$$formSmtp__host');
    $port = $TSunic->Input->param('$$$formSmtp__port');
    $auth = $TSunic->Input->param('$$$formSmtp__auth');
    $connsecurity = $TSunic->Input->param('$$$formSmtp__connsecurity');
    $user = $TSunic->Input->param('$$$formSmtp__user');

    // get new Smtp object
    $Smtp = $TSunic->get('$$$Smtp');

    // validate input
    if (!$Smtp->isValidEMail($email)
	OR !$Smtp->isValidPassword($password)
	OR !$Smtp->isValidDescription($description)
	OR !$Smtp->isValidEMailname($emailname)
    ) {
	$TSunic->Log->alert('error', '{ADDSMTP__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // create new smtp
    if (!$Smtp->create($email, $password, $description, $emailname)) {
	$TSunic->Log->alert('error', '{ADDSMTP__ERROR}');
	$TSunic->redirect('back');
    }

    // add mailaccount
    if (!empty($fk_mail__account)) {
	$Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mail__account);
	if (!$Mailaccount OR !$Smtp->setMailaccount($Mailaccount)) {
	    $TSunic->Log->alert('error', '{ADDSMTP__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // try to set connection
    if (!$Smtp->setAutoConnection($host, $port, $user, $auth, $connsecurity)) {
	$TSunic->Log->alert('error', '{ADDSMTP__CONNERROR}');
	$TSunic->redirect('$$$showEditSmtp', array('$$$id' => $Smtp->getInfo('id')));
    }

    // success
    $TSunic->Log->alert('info', '{ADDSMTP__SUCCESS}');
    $TSunic->redirect('$$$showMailservers');

    return true;
}
?>
