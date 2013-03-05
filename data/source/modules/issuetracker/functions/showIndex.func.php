<!-- | FUNCTION show index -->
<?php
function $$$showIndex () {
    global $TSunic;

    // get all issues
    $Helper = $TSunic->get('$bp$Helper');
    $issues = $Helper->getObjects('$$$Issues');

    // activate template
    $data = array('issues' => $issues);
    $TSunic->Tmpl->activate('$$$showIndex', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

    return true;
}
?>
