<!-- | FUNCTION show day -->
<?php
function $$$showDay () {
    global $TSunic;

    $year = $TSunic->Temp->getParameter('$$$year');
    $month = $TSunic->Temp->getParameter('$$$month');
    $day = $TSunic->Temp->getParameter('$$$day');
    if (empty($year)) $year = date('Y');
    if (empty($month)) $month = date('n');
    if (empty($day)) $day = date('j');

    // get all dates of day
    $startofday = mktime(0, 0, 0, $month, $day, $year);
    $Calendar = $TSunic->get('$$$Calendar');
    $dates = $Calendar->getDates($startofday, $startofday + 24 * 60 * 60);

    // activate template
    $data = array('dates' => $dates);
    $TSunic->Tmpl->activate('$$$showDay', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDAY__TITLE}'));

    return true;
}
?>
