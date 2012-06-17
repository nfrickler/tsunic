<!-- | FUNCTION show form to add member to accessgroup -->
<?php
function $$$showAddAccessgroupmember () {
    global $TSunic;

    // get empty accessgroup
    $id = $TSunic->Temp->getParameter('$$$id');
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);

    // get all users not in group
    $users = $TSunic->Usr->allUsers();
    foreach ($Accessgroup->getMembers() as $index => $value) {
	unset($users[$index]);
    }

    // activate template
    $data = array(
	'Accessgroup' => $Accessgroup,
	'users' => $users,
    );
    $TSunic->Tmpl->activate('$$$showAddAccessgroupmember', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDACCESSGROUPMEMBER__TITLE}'));

    return true;
}
?>
