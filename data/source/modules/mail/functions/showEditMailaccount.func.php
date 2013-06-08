<!-- | FUNCTION show form to edit mail account -->
<?php
function $$$showEditMailaccount () {
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
    $data = array(
	'Mailaccount' => $Mailaccount,
	'name' => $Mailaccount->getInfo('name')
    );
    $TSunic->Tmpl->activate('$$$showEditMailaccount', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITMAILACCOUNT__TITLE}'));

    return true;
}
?>
