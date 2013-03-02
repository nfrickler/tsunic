<!-- | FUNCTION show form to add new mail account -->
<?php
function $$$showAddMailaccount () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get empty Mailaccount object
    $Mailaccount = $TSunic->get('$$$Mailaccount');

    // activate template
    $data = array('Mailaccount' => $Mailaccount);
    $TSunic->Tmpl->activate('$$$showAddMailaccount', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDMAILACCOUNT__TITLE}'));

    return true;
}
?>
