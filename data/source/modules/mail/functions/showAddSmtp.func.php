<!-- | FUNCTION show form to add new SMTP -->
<?php
function $$$showAddSmtp () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $fk_mailaccount = $TSunic->Temp->getParameter('fk_mailaccount');

    // get empty Smtp object
    $Smtp = $TSunic->get('$$$Smtp');

    // set mailaccount?
    if (!empty($fk_mailaccount)) {
	$Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mailaccount);
	$Smtp->setMailaccount($Mailaccount);
    }

    // get SuperMail object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array(
	'Smtp' => $Smtp,
	'mailaccounts' => $SuperMail->getMailaccounts()
    );
    $TSunic->Tmpl->activate('$$$showAddSmtp', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDSMTP__TITLE}'));

    return true;
}
?>
