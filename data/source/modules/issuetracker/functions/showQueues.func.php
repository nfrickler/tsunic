<!-- | FUNCTION show list of all queues -->
<?php
function $$$showQueues () {
    global $TSunic;

    // get all issues
    $Helper = $TSunic->get('$bp$Helper');
    $queues = $Helper->getObjects('$$$Queue');

    // activate template
    $data = array('queues' => $queues);
    $TSunic->Tmpl->activate('$$$showQueues', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWQUEUES__TITLE}'));

    return true;
}
?>
