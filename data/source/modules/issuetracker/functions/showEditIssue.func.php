<!-- | FUNCTION show page to edit issue -->
<?php
function $$$showEditIssue () {
    global $TSunic;

    // get Issue object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Issue = $TSunic->get('$$$Issue', $id);

    // activate template
    $data = array(
	'Issue' => $Issue,
    );
    $TSunic->Tmpl->activate('$$$showEditIssue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITISSUE__TITLE}'));

    return true;
}
?>
