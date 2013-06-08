<!-- | FUNCTION show index -->
<?php
function $$$showIndex () {
    global $TSunic;

    // get selected queue
    $queue = $TSunic->Input->uint('$$$queue');
    $Queue = $TSunic->get('$$$Queue', $queue);

    // get all queues and issues in selected queue
    $Helper = $TSunic->get('$bp$Helper');
    $queues = $Helper->getObjects('$$$Queue');
    $issues = $Queue->getIssues();

    // activate template
    $data = array(
	'issues' => $issues,
	'Queue' => $Queue,
	'queues' => $queues,
    );
    $TSunic->Tmpl->activate('$$$showIndex', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

    return true;
}
?>
