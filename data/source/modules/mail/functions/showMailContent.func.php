<!-- | FUNCTION show content of mail -->
<?php
function $$$showMailContent () {
    global $TSunic;

    // get mail object
    $id = $TSunic->Input->uint('$$$id');
    $Mail = $TSunic->get('$$$Mail', $id);

    // activate template
    $data = array('mail' => $Mail);
    $TSunic->Tmpl->activate('$$$showMailContent', false, $data);

    // set charset
    $charset = $Mail->getInfo('charset');
    if (!empty($charset)) {
	header('Content-Type: text/html; charset='.$charset);

    }

    return true;
}
?>
