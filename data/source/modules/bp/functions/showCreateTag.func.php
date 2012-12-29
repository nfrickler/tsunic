<!-- | FUNCTION show form to create tag -->
<?php
function $$$showCreateTag () {
    global $TSunic;

    // create empty object
    $Tag = $TSunic->get('$$$Tag');

    // activate template
    $data = array(
	'Tag' => $Tag
    );
    $TSunic->Tmpl->activate('$$$showCreateTag', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATETAG__TITLE}'));

    return true;
}
?>
