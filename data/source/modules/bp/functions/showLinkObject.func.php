<!-- | FUNCTION show form to link an object -->
<?php
function $$$showLinkObject () {
    global $TSunic;

    // get input
    $fk_obj = $TSunic->Input->uint('$$$fk_obj');
    $backlink = $TSunic->Input->param('backlink');
    $headline = $TSunic->Input->param('$$$headline');
    $infotext = $TSunic->Input->param('$$$infotext');
    if (empty($headline)) $headline = '{SHOWLINKOBJECT__H1}';
    if (empty($infotext)) $infotext ='{SHOWLINKOBJECT__INFOTEXT}';

    // get all objects
    $Helper = $TSunic->get('$bp$Helper');
    $objects_all = $Helper->getObjects();

    // Distribute objects by class and remove the object fk_obj from list
    $objects = array();
    foreach ($objects_all as $index => $Value) {
	if ($Value->getInfo('id') == $fk_obj) continue;

	$class = $Value->getInfo('class');
	if (!isset($objects[$class])) $objects[$class] = array();
	$objects[$class][] = $Value->getObject();
    }

    // activate template
    $data = array(
	'fk_obj' => $fk_obj,
	'headline' => $headline,
	'infotext' => $infotext,
	'backlink' => $backlink,
	'objects' => $objects
    );
    $TSunic->Tmpl->activate('$$$showLinkObject', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWLINKOBJECT__TITLE}'));

    return true;
}
?>
