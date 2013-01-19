<!-- | FUNCTION show page to edit date -->
<?php
function $$$showEditDate () {
    global $TSunic;

    // get Date object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Date = $TSunic->get('$$$Date', $id);

    // presets
    $preset_start = $Date->getInfo('start');
    $preset_stop = $Date->getInfo('stop');

    // activate template
    $data = array(
	'Date' => $Date,
	'preset_start' => $preset_start,
	'preset_stop' => $preset_stop
    );
    $TSunic->Tmpl->activate('$$$showEditDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITDATE__TITLE}'));

    return true;
}
?>
