<!-- | FUNCTION show form to add tag to profile -->
<?php
function $$$showAddTag () {
    global $TSunic;

    // create empty object
    $fk_obj = $TSunic->Temp->getParameter('fk_obj');

    // get all tags
    $Selection = $TSunic->get('$bp$Selection');
    $tags = $Selection->getAllTags();

    // activate template
    $data = array(
	'fk_obj' => $fk_obj,
	'tags' => $tags
    );
    $TSunic->Tmpl->activate('$$$showAddTag', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDTAG__TITLE}'));

    return true;
}
?>
