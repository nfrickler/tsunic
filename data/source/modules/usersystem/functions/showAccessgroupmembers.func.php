<!-- | FUNCTION show list of accessgroupmembers -->
<?php
function $$$showAccessgroupmembers () {
    global $TSunic;

    // get accessgroup
    $id = $TSunic->Temp->getParameter('$$$id');
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);
    if (!$Accessgroup) {
	$TSunic->redirect('back');
    }

    // activate template
    $data = array(
	'Accessgroup' => $Accessgroup,
	'members' => $Accessgroup->getMembers(),
    );
    $TSunic->Tmpl->activate('$$$showAccessgroupmembers', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESSGROUPMEMBERS__TITLE}'));

    return true;
}
?>
