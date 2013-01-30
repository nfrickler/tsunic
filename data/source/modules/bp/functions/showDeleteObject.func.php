<!-- | FUNCTION delete object? -->
<?php
function $$$showDeleteObject () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getParameter('$$$id');
    $backlink = $TSunic->Temp->getParameter('$$$backlink');

    // get Object
    $Object = $TSunic->get('$bp$BpObject', $id);
    $Object = $Object->getObject();
    if (!$Object or !$Object->isValid()) {
	$TSunic->Log->alert('error', '{SHOWDELETEOBJECT__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // activate template
    $data = array(
	'Object' => $Object,
	'backlink' => $backlink
    );
    $TSunic->Tmpl->activate('$$$showDeleteObject', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEOBJECT__TITLE}'));

    return true;
}
?>
