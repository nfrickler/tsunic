<!-- | FUNCTION show main page -->
<?php
function $$$showMain () {
	global $TSunic;

	// get all modules
	$all_modules = $TSunic->getModules();
	$modules = array();
	foreach ($all_modules as $index => $values) {
	    $modules[] = array(
		'id' => $values['id'],
		'name' => "{MOD".$values['id']."__NAME}",
	    );
	}

	// activate template
	$data = array(
	    'modules' => $modules,
	);
	$TSunic->Tmpl->activate('$$$showMain', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAIN__TITLE}'));

	return true;
}
?>
