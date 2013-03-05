<!-- | FUNCTION show form to create issue -->
<?php
function $$$showCreateIssue () {
    global $TSunic;

    // create empty object
    $Issue = $TSunic->get('$$$Issue');

    // activate template
    $data = array(
	'Issue' => $Issue
    );
    $TSunic->Tmpl->activate('$$$showCreateIssue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEISSUE__TITLE}'));

    return true;
}
?>
