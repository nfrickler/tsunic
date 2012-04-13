<!-- | FUNCTION show config -->
<?php
function $$$showConfig () {
	global $TSunic;

	// get config
	$config_raw = $TSunic->Usr->getConfig()->getAll();
	$config = array();
	foreach ($config_raw as $index => $values) {

		// get module
		$cache = explode("__", $index);

		// create new array
		if (!isset($config[$cache[0]])) $config[$cache[0]] = array();
		$config[$cache[0]][$index] = array(
			'name' => '{'.strtoupper($cache[0]."__CONFIG__".$cache[1]).'}',
			'value' => $values['value'],
			'default' => $values['default'],
			'description' => '{'.strtoupper($cache[0]."__CONFIG__".$cache[1]."__DESCRIPTION").'}',
			'formtype' => $values['formtype'],
		);

		// load options for select field
		if ($values['formtype'] == "select") {
			include_once $cache[0].'___system_config.func.php';
			eval('$config[$cache[0]][$index]["options"] = '.
				$cache[0].'__'.$values['options'].'();');
		}
	}

	// activate template
	$data = array('config' => $config);
	$TSunic->Tmpl->activate('$$$showConfig', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCONFIG__TITLE}'));

	return true;
}
?>
