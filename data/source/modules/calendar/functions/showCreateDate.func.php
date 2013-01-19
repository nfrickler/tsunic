<!-- | FUNCTION show form to create date -->
<?php
function $$$showCreateDate () {
    global $TSunic;

    // create empty object
    $Date = $TSunic->get('$$$Date');

    // presets
    $preset_start = $TSunic->Temp->getParameter('$$$start');
    $preset_stop = $TSunic->Temp->getParameter('$$$stop');
    if (!$preset_start) $preset_start = mktime(date('H'), 0, 0, date('m'), date('d'), date('Y'));
    if (!$preset_stop) $preset_stop = $preset_start + 60 * 60;

    // activate template
    $data = array(
	'Date' => $Date,
	'preset_start' => $preset_start,
	'preset_stop' => $preset_stop
    );
    $TSunic->Tmpl->activate('$$$showCreateDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEDATE__TITLE}'));

    return true;
}
?>
