<!-- | FUNCTION show day -->
<?php
function $$$showDay () {
    global $TSunic;

    $time = $TSunic->Input->param('$$$time');
    if (empty($time)) $time = time();

    // get all dates of day
    $startofday = mktime(0, 0, 0, date('m', $time), date('d', $time), date('Y', $time));
    $Calendar = $TSunic->get('$$$Calendar');
    $dates = $Calendar->getDates($startofday, $startofday + 24 * 3600);

    // activate template
    $data = array(
	'dates' => $dates,
	'time' => $time
    );
    $TSunic->Tmpl->activate('$$$showDay', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDAY__TITLE}'));

    return true;
}
?>
