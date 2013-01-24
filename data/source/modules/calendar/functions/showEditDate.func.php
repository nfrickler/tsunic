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
    $preset_repeatstop = $Date->getInfo('repeatstop');
    if (empty($preset_repeatstop)) $preset_repeatstop = $preset_stop;
    $preset_radio = ($Date->getInfo('repeatcount')) ? true : false;

    // activate template
    $data = array(
	'Date' => $Date,
	'preset_start' => $preset_start,
	'preset_stop' => $preset_stop,
	'preset_repeatstop' => $preset_repeatstop,
	'preset_radio' => $preset_radio
    );
    $TSunic->Tmpl->activate('$$$showEditDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITDATE__TITLE}'));

    return true;
}
?>
