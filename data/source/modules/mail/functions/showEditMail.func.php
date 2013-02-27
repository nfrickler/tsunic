<!-- | FUNCTION show form to edit mail -->
<?php
function $$$showEditMail () {
    global $TSunic;

    // get all Smtp objects
    $SuperMail = $TSunic->get('$$$SuperMail');
    $sender = $SuperMail->getSmtps(true);

    // get Mail object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Mail = $TSunic->get('$$$Mail', $id);
    if (!$Mail->isValid()) {
	$TSunic->Log->alert('error', '{SHOWEDITMAIL__NOTEXISTING}');
	$TSunic->redirect('back');
    }

    // activate template
    $data = array(
	'Mail' => $Mail,
	'sender' => $sender
    );
    $TSunic->Tmpl->activate('$$$showEditMail', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITMAIL__TITLE}'));

    return true;
}
?>
