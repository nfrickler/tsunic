<!-- | FUNCTION show form to choose object -->
<?php
function $$$showChooseObject () {
    global $TSunic;

    // get input
    $fk_bit = $TSunic->Input->uint('$$$fk_bit');
    $backlink = $TSunic->Input->param('backlink');
    $headline = $TSunic->Input->param('$$$headline');
    $infotext = $TSunic->Input->param('$$$infotext');
    if (empty($headline)) $headline = '{SHOWCHOOSEOBJECT__H1}';
    if (empty($infotext)) $infotext ='{SHOWCHOOSEOBJECT__INFOTEXT}';

    // get Bit object
    $Bit = $TSunic->get('$$$Bit', $fk_bit);

    // get all objects
    $class = $Bit->getTag()->getType()->getInfo('name');
    $Helper = $TSunic->get('$bp$Helper');
    $objects_all = $Helper->getObjects($class);

    // remove the object, where fk_bit belongs to, from list
    $fk_object = $Bit->getInfo('fk_object');
    $objects = array();
    foreach ($objects_all as $index => $Value) {
	if ($Value->getInfo('id') != $fk_object) $objects[] = $Value;
    }

    // activate template
    $data = array(
	'fk_bit' => $fk_bit,
	'headline' => $headline,
	'infotext' => $infotext,
	'backlink' => $backlink,
	'objects' => $objects
    );
    $TSunic->Tmpl->activate('$$$showChooseObject', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCHOOSEOBJECT__TITLE}'));

    return true;
}
?>
