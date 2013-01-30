<!-- | FUNCTION show form to choose object -->
<?php
function $$$showChooseObject () {
    global $TSunic;

    // get input
    $fk_bit = $TSunic->Temp->getParameter('fk_bit');
    $backlink = $TSunic->Temp->getParameter('backlink');

    // get Bit object
    $Bit = $TSunic->get('$$$Bit', $fk_bit);

    // get all objects
    $class = $Bit->getTag()->getType()->getInfo('name');
    $Helper = $TSunic->get('$bp$Helper');
    $objects = $Helper->getObjects($class);

    // activate template
    $data = array(
	'fk_bit' => $fk_bit,
	'backlink' => $backlink,
	'objects' => $objects
    );
    $TSunic->Tmpl->activate('$$$showChooseObject', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCHOOSEOBJECT__TITLE}'));

    return true;
}
?>
