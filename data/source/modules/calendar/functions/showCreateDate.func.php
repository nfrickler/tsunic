<!-- | FUNCTION show form to create date -->
<?php
function $$$showCreateDate () {
    global $TSunic;

    // create empty object
    $Date = $TSunic->get('$$$Date');

    // presets
    $preset_start = $TSunic->Input->param('$$$start');
    $preset_stop = $TSunic->Input->param('$$$stop');
    $preset_repeatstop = $TSunic->Input->param('$$$repeatstop');
    if (!$preset_start) $preset_start =
	mktime(date('H'), 0, 0, date('m'), date('d'), date('Y'));
    if (!$preset_stop) $preset_stop = $preset_start + 60 * 60;
    if (!$preset_repeatstop) $preset_repeatstop = $preset_stop;

    // activate template
    $data = array(
	'Date' => $Date,
	'preset_start' => $preset_start,
	'preset_stop' => $preset_stop,
	'preset_repeatstop' => $preset_repeatstop,
	'preset_radio' => 1
    );
    $TSunic->Tmpl->activate('$$$showCreateDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEDATE__TITLE}'));

    return true;
}
?>
