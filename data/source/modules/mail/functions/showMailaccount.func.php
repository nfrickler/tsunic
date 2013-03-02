<!-- | FUNCTION show mail account -->
<?php
function $$$showMailaccount () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get mailaccount object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Mailaccount = $TSunic->get('$$$Mailaccount', $id);

    // activate template
    $data = array(
	'Mailaccount' => $Mailaccount,
	'name' => $Mailaccount->getInfo('name')
    );
    $TSunic->Tmpl->activate('$$$showMailaccount', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAILACCOUNT__TITLE}'));

    return true;
}
?>
