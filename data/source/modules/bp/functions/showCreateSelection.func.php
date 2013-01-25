<!-- | FUNCTION show form to create selection -->
<?php
function $$$showCreateSelection () {
    global $TSunic;

    // create empty object
    $fk_tag = $TSunic->Temp->getParameter('fk_tag');
    $Selection = $TSunic->get('$$$Selection');

    // get all selection-/radio- tags
    $Helper = $TSunic->get('$$$Helper');
    $tags = array();
    foreach ($Helper->getTags() as $index => $Value) {
	$typename = $Value->getType()->getInfo('name');
	if ($typename == 'selection' or $typename == 'radio')
	    $tags[] = $Value;
    }

    // activate template
    $data = array(
	'fk_tag' => $fk_tag,
	'tags' => $tags,
	'Selection' => $Selection
    );
    $TSunic->Tmpl->activate('$$$showCreateSelection', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATESELECTION__TITLE}'));

    return true;
}
?>
