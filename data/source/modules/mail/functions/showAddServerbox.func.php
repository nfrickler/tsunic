<!-- | FUNCTION show form to add new serverbox -->
<?php
function $$$showAddServerbox () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Mailaccount object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Mailaccount = $TSunic->get('$$$Mailaccount', $id);

    // valid mailaccount?
    if (!$Mailaccount->isValid()) {
	$TSunic->Log->alert('error', '{SHOWADDSERVERBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // get empty Serverbox object
    $Serverbox = $TSunic->get('$$$Serverbox');

    // create SuperMail object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array(
	'Serverbox' => $Serverbox,
	'Mailaccount' => $Mailaccount,
	'mailboxes' => $SuperMail->getMailboxes()
    );
    $TSunic->Tmpl->activate('$$$showAddServerbox', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDSERVERBOX__TITLE}'));

    return true;
}
?>
