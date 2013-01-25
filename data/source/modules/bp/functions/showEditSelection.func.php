<!-- | FUNCTION show page to edit selection -->
<?php
function $$$showEditSelection () {
    global $TSunic;

    // get Selection object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Selection = $TSunic->get('$$$Selection', $id);

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
	'Selection' => $Selection,
	'tags' => $tags
    );
    $TSunic->Tmpl->activate('$$$showEditSelection', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITSELECTION__TITLE}'));

    return true;
}
?>
