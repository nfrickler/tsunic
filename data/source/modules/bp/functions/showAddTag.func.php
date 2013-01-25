<!-- | FUNCTION show form to add tag to object -->
<?php
function $$$showAddTag () {
    global $TSunic;

    // get input
    $fk_obj = $TSunic->Temp->getParameter('fk_obj');
    $backlink = $TSunic->Temp->getParameter('backlink');

    // get Object
    $Obj = $TSunic->get('$$$BpObject', $fk_obj);
    $Obj = $Obj->getObject();

    // get Helper object
    $Helper = $TSunic->get('$bp$Helper');

    // activate template
    $data = array(
	'fk_obj' => $fk_obj,
	'backlink' => $backlink,
	'tags' => $Helper->getTags()
    );
    $TSunic->Tmpl->activate('$$$showAddTag', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDTAG__TITLE}'));

    return true;
}
?>
