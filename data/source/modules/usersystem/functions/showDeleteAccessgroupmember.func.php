<!-- | FUNCTION show page to confirm deletion of member from accessgroup -->
<?php
function $$$showDeleteAccessgroupmember () {
    global $TSunic;

    // get Accessgroup
    $id = $TSunic->Temp->getParameter('$$$id');
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);
    $userid = $TSunic->Temp->getParameter('$$$userid');
    $User = $TSunic->get('$$$User', $userid);

    // activate template
    $data = array(
	'Accessgroup' => $Accessgroup,
	'User' => $User,
    );
    $TSunic->Tmpl->activate('$$$showDeleteAccessgroupmember', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEACCESSGROUPMEMBER__TITLE}'));

    return true;
}
?>
