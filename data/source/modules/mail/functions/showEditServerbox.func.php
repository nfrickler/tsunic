<!-- | FUNCTION show form to edit serverbox -->
<?php
function $$$showEditServerbox () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Serverbox object
    $id = $TSunic->Input->uint('$$$id');
    $Serverbox = $TSunic->get('$$$Serverbox', $id);

    // create SuperMail-object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array(
	'Serverbox' => $Serverbox,
	'Mailaccount' => $Serverbox->getMailaccount(),
	'mailboxes' => $mailboxes = $SuperMail->getMailboxes()
    );
    $TSunic->Tmpl->activate('$$$showEditServerbox', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITSERVERBOX__TITLE}'));

    return true;
}
?>
