<!-- | FUNCTION delete serverbox? -->
<?php
function $$$showDeleteServerbox () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Serverbox object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Serverbox = $TSunic->get('$$$Serverbox', $id);

    // serverbox exists?
    if (!$Serverbox->isValid()) {
	$TSunic->redirect('back');
    }

    // activate template
    $data = array('Serverbox' => $Serverbox);
    $TSunic->Tmpl->activate('$$$showDeleteServerbox', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETESERVERBOX__TITLE}'));

    return true;
}
?>
