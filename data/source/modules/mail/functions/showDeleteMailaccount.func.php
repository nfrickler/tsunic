<!-- | FUNCTION delete mail account? -->
<?php
function $$$showDeleteMailaccount () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Mailaccount object
    $id = $TSunic->Input->uint('$$$id');
    $Mailaccount = $TSunic->get('$$$Mailaccount', $id);

    // activate template
    $data = array('Mailaccount' => $Mailaccount);
    $TSunic->Tmpl->activate('$$$showDeleteMailaccount', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEMAILACCOUNT__TITLE}'));

    return true;
}
?>
