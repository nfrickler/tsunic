<!-- | FUNCTION show queue -->
<?php
function $$$showQueue () {
    global $TSunic;

    // get Queue object
    $id = $TSunic->Input->uint('$$$id');
    $Queue = $TSunic->get('$$$Queue', $id);

    // activate template
    $data = array(
	'Queue' => $Queue,
    );
    $TSunic->Tmpl->activate('$$$showQueue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWQUEUE__TITLE}'));

    return true;
}
?>
