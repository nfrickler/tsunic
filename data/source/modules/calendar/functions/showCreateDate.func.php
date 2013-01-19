<!-- | FUNCTION show form to create date -->
<?php
function $$$showCreateDate () {
    global $TSunic;

    // create empty object
    $Date = $TSunic->get('$$$Date');

    // activate template
    $data = array(
	'Date' => $Date
    );
    $TSunic->Tmpl->activate('$$$showCreateDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEDATE__TITLE}'));

    return true;
}
?>
