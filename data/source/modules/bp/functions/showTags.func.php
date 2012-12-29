<!-- | FUNCTION show tags -->
<?php
function $$$showTags () {
    global $TSunic;

    // get all tags
    $Selection = $TSunic->get('$$$Selection');
    $tags = $Selection->getAllTags();

    // activate template
    $data = array('tags' => $tags);
    $TSunic->Tmpl->activate('$$$showTags', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWTAGS__TITLE}'));

    return true;
}
?>
