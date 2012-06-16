<!-- | function to add new mail account -->
<?php
function $$$addMailaccount () {
    global $TSunic;

    // get input
    $email = $TSunic->Temp->getPost('$$$formMailaccount__email');
    $password = $TSunic->Temp->getPost('$$$formMailaccount__password');
    $name = $TSunic->Temp->getPost('$$$formMailaccount__name');
    $description = $TSunic->Temp->getPost('$$$formMailaccount__description');
    $host = $TSunic->Temp->getPost('$$$formMailaccount__host');
    $port = $TSunic->Temp->getPost('$$$formMailaccount__port');
    $user = $TSunic->Temp->getPost('$$$formMailaccount__user');
    $protocol = $TSunic->Temp->getPost('$$$formMailaccount__protocol');
    $auth = $TSunic->Temp->getPost('$$$formMailaccount__auth');
    $connsecurity = $TSunic->Temp->getPost('$$$formMailaccount__connsecurity');

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
    if (!$Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity)) {
	$TSunic->Log->alert('error', '{ADDMAILACCOUNT__CONNERROR}');
	$TSunic->redirect('$$$showEditMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));
    }

    // success
    $TSunic->Log->alert('info', '{ADDMAILACCOUNT__SUCCESS}');
    $TSunic->redirect('$$$showMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));

    return true;
}
?>
