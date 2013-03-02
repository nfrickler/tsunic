<!-- | FUNCTION show mailservers -->
<?php
function $$$showMailservers () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get SuperMail-object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array(
	'mailaccounts' => $SuperMail->getMailaccounts(),
	'smtps' => $SuperMail->getSmtps(false)
    );
    $TSunic->Tmpl->activate('$$$showMailservers', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAILSERVERS__TITLE}'));

    return true;
}
?>
