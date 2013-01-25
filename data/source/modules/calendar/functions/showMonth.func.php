<!-- | FUNCTION show month -->
<?php
function $$$showMonth () {
    global $TSunic;

    $time = $TSunic->Temp->getParameter('$$$time');
    if (empty($time)) $time = time();

    // get all dates of month
    $startofmonth = mktime(0, 0, 0, date('m', $time), 1, date('Y', $time));
    $stopofmonth = strtotime("+1 month", $startofmonth);
    $Calendar = $TSunic->get('$$$Calendar');
    $dates = $Calendar->getDates($startofmonth, $stopofmonth);


    // sort dates by days
    $bydays = array();
    foreach ($dates as $index => $values) {
	$day = date('d', $values['time']);
	if (!isset($bydays[$day]))
	    $bydays[$day] = array();
	$bydays[$day][] = $values;
    }

    // activate template
    $data = array(
	'dates' => $bydays,
	'time' => $time
    );
    $TSunic->Tmpl->activate('$$$showMonth', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMONTH__TITLE}'));

    return true;
}
?>
