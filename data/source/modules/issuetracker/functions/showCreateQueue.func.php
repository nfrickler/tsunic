<!-- | FUNCTION show form to create queue -->
<?php
function $$$showCreateQueue () {
    global $TSunic;

    // create empty object
    $Queue = $TSunic->get('$$$Queue');

    // activate template
    $data = array(
	'Queue' => $Queue
    );
    $TSunic->Tmpl->activate('$$$showCreateQueue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEQUEUE__TITLE}'));

    return true;
}
?>
