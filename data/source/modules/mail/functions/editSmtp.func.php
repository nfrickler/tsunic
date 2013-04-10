<!-- | FUNCTION edit Smtp -->
<?php
function $$$editSmtp () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $id = $TSunic->Temp->getParameter('$$$formSmtp__id');
    $fk_mail__account = $TSunic->Temp->getParameter('$$$formSmtp__mailaccount');
    $email = $TSunic->Temp->getParameter('$$$formSmtp__email');
    $password = $TSunic->Temp->getParameter('$$$formSmtp__password');
    $emailname = $TSunic->Temp->getParameter('$$$formSmtp__emailname');
    $description = $TSunic->Temp->getParameter('$$$formSmtp__description');
    $host = $TSunic->Temp->getParameter('$$$formSmtp__host');
    $port = $TSunic->Temp->getParameter('$$$formSmtp__port');
    $auth = $TSunic->Temp->getParameter('$$$formSmtp__auth');
    $connsecurity = $TSunic->Temp->getParameter('$$$formSmtp__connsecurity');
    $user = $TSunic->Temp->getParameter('$$$formSmtp__user');

    // get smtp-object
    $Smtp = $TSunic->get('$$$Smtp', $id);

    // validate input
    if (!$Smtp->isValidEMail($email)
	OR !$Smtp->isValidPassword($password)
	OR !$Smtp->isValidDescription($description)
	OR !$Smtp->isValidEMailname($emailname)
    ) {
	$TSunic->Log->alert('error', '{EDITSMTP__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // edit smtp
    if (!$Smtp->edit($email, $password, $description, $emailname)) {
	$TSunic->Log->alert('error', '{EDITSMTP__ERROR}');
	$TSunic->redirect('back');
    }

    // update mailaccount
    if (!empty($fk_mail__account)) {
	$Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mail__account);
	if (!$Mailaccount OR !$Smtp->setMailaccount($Mailaccount)) {
	    $TSunic->Log->alert('error', '{ADDSMTP__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // try to set connection
    if (!$Smtp->setAutoConnection($host, $port, $user, $auth, $connsecurity)) {
	$TSunic->Log->alert('error', '{EDITSMTP__CONNERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{EDITSMTP__SUCCESS}');
    $TSunic->redirect('back', 2);

    return true;
}
?>
