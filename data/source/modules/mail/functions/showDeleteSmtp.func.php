<!-- | FUNCTION delete Smtp object? -->
<?php
function $$$showDeleteSmtp () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Smtp object
    $id = $TSunic->Input->uint('$$$id');
    $Smtp = $TSunic->get('$$$Smtp', $id);

    // activate template
    $data = array('Smtp' => $Smtp);
    $TSunic->Tmpl->activate('$$$showDeleteSmtp', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETESMTP__TITLE}'));

    return true;
}
?>
