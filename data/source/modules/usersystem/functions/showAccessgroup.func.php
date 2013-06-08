<!-- | FUNCTION show one accessgroup -->
<?php
function $$$showAccessgroup () {
    global $TSunic;

    // get accessgroup
    $id = $TSunic->Input->uint('$$$id');
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);

    // get all accessgroups
    $accessgroups = array();
    foreach ($TSunic->Usr->getAccess()->allGroups() as $iid => $values) {
	if ($iid == 1 or $iid == $id or $Accessgroup->isInChildren($iid)) continue;
	$accessgroups[$iid] = $values;
    }

    // activate template
    $data = array(
	'Accessgroup' => $Accessgroup,
	'accessgroups' => $accessgroups,
    );
    $TSunic->Tmpl->activate('$$$showAccessgroup', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESSGROUP__TITLE}'));

    return true;
}
?>
