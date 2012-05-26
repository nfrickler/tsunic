<!-- | function to show mail -->
<?php
function $$$showMail () {
	global $TSunic;

	// get mail object
	$id = $TSunic->Temp->getParameter('id');
	$Mail = $TSunic->get('$$$Mail', array($id));

	// activate template
	$data = array('mail' => $Mail);
	$TSunic->Tmpl->activate('$$$showMail', '$system$content', $data);

	return true;
}
?>
