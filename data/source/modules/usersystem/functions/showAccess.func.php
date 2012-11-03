<!-- | FUNCTION show access -->
<?php
function $$$showAccess () {
    global $TSunic;
    $isuser = true;
    $allow_edit = $TSunic->Usr->access('editAllAccess');
    $id = $TSunic->Usr->getInfo('id');

    // access?
    if (!$TSunic->Usr->access('$$$seeOwnAccess')) {
	$TSunic->Log->alert('error', '{SHOWACCESS__PERMISSION_DENIED}');
	$TSunic->redirect('back');
	return false;
    }

    # get account-id
    $user = $TSunic->Temp->getParameter('$$$user');
    $group = $TSunic->Temp->getParameter('$$$group');

    // get user object
    if ($user == $TSunic->Usr->getInfo('id') or (empty($user) and empty($group))) {
	$Object = $TSunic->Usr->getAccess();
	$name = $TSunic->Usr->getInfo('name');
	if ($TSunic->Usr->isRoot()) $allow_edit = false;
    } else {

	// check rights
	if (!$TSunic->Usr->access('$$$seeAllAccess')) {
	    $TSunic->Log->alert('error', '{SHOWACCESS__PERMISSION_DENIED}');
	    $TSunic->redirect('$$$showAccess');
	}

	// get object
	if ($user) {
	    $Object = $TSunic->get('$$$User', $user);
	    $name = $Object->getInfo('name');
	    $id = $Object->getInfo('id');
	    if ($Object->isRoot()) $allow_edit = false;
	    $Object = $Object->getAccess();
	} else {
	    $isuser = false;
	    $Object = $TSunic->get('$$$Accessgroup', $group);
	    $id = $Object->getInfo('id');
	    $name = $Object->getInfo('name');
	}
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
	    'value' => $Object->check($index, false),
	    'description' => '{'.strtoupper("${module}__ACCESS__${purename}_DESCRIPTION").'}',
	    'default' => ($isuser ? $Object->checkGroups($index) : $Object->checkParent($index))
		? '{SHOWACCESS__YES}' : '{SHOWACCESS__NO}',
	);
    }

    // activate template
    $data = array(
	'id' => $id,
	'name' => $name,
	'accessnames' => $accessnames_by_module,
	'allowEdit' => $allow_edit,
	'groups' => $TSunic->Usr->getAccess()->allGroups(),
	'users' => $TSunic->Usr->allUsers(),
	'isuser' => $isuser,
    );
    $TSunic->Tmpl->activate('$$$showAccess', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESS__TITLE}'));

    return true;
}
?>
