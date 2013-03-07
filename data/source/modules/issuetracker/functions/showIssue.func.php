<!-- | FUNCTION show issue -->
<?php
function $$$showIssue () {
    global $TSunic;

    // get Issue object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Issue = $TSunic->get('$$$Issue', $id);

    // activate template
    $data = array(
	'Issue' => $Issue,
    );
    $TSunic->Tmpl->activate('$$$showIssue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWISSUE__TITLE}'));

    return true;
}
?>
