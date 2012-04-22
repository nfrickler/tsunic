<!-- | FUNCTION show access -->
<?php
function $$$showAccess () {
	global $TSunic;

	# get account-id
	$fk_account = $TSunic->Temp->getParameter('fk_account');

	// get user object
	if (empty($fk_account) or $fk_account == $TSunic->Usr->getInfo('id')) {
		$User = $TSunic->Usr;
	} else {

		// check rights
		if (!$TSunic->Usr->access('$$$seeAllAccess')) {
			$TSunic->Log->add('{SHOWACCESS__PERMISSION_DENIED}', 3);
			$TSunic->redirect('back');
		}

		$User = $TSunic->get('$$$User', $fk_account);
	}

	// get all accessnames
	$accessnames = $TSunic->Usr->getAccess()->getAccessnames();
	$accessnames_by_module = array();
	foreach ($accessnames as $index => $values) {
		$cache = explode('__', $index);
		$module = $cache[0];
		$purename = $cache[1];
		if (!isset($accessnames_by_module[$cache[0]]))
			$accessnames_by_module[$cache[0]] = array();
		$accessnames_by_module[$cache[0]][$index] = array(
			'name' => '{'.strtoupper("${module}__ACCESS__${purename}").'}',
			'value' => $User->access($index),
			'description' => '{'.strtoupper("${module}__ACCESS__${purename}_DESCRIPTION").'}',
			'groups' => $User->getAccess()->checkGroups($index)
				? 'SHOWACCESS__YES}' : '{SHOWACCESS__NO}',
		);
	}

	// activate template
	$data = array(
		'User' => $User,
		'accessnames' => $accessnames_by_module,
		'allowEdit' => $TSunic->Usr->access('$$$editAllAccess'),
	);
	$TSunic->Tmpl->activate('$$$showAccess', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESS__TITLE}'));

	return true;
}
?>
