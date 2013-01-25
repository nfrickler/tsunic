<!-- | FUNCTION show tags -->
<?php
function $$$showTags () {
    global $TSunic;

    // get all tags
    $Helper = $TSunic->get('$$$Helper');

    // activate template
    $data = array('tags' => $Helper->getTags());
    $TSunic->Tmpl->activate('$$$showTags', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWTAGS__TITLE}'));

    return true;
}
?>
