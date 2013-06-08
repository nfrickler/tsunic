<!-- | FUNCTION show page to confirm deletion of member from accessgroup -->
<?php
function $$$showDeleteAccessgroupmember () {
    global $TSunic;

    // get Accessgroup
    $id = $TSunic->Input->uint('$$$id');
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);
    $userid = $TSunic->Input->uint('$$$userid');
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
