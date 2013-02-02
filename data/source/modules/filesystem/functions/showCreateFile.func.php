<!-- | FUNCTION show form to create filesystem file -->
<?php
function $$$showCreateFile () {
    global $TSunic;

    // get directory
    $fk_directory = $TSunic->Temp->getParameter('fk_directory');

    // create empty object
    $File = $TSunic->get('$$$File');
    $Dir = $TSunic->get('$$$Directory');

    // activate template
    $data = array(
	'File' => $File,
	'fk_directory' => $fk_directory
    );
    $TSunic->Tmpl->activate('$$$showCreateFile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEFILE__TITLE}'));

    return true;
}
?>
