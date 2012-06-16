<!-- | function to show form to add new mailbox -->
<?php
function $$$showAddMailbox () {
    global $TSunic;

    // create new mailbox-object
    $Mailbox = $TSunic->get('$$$Mailbox');

    // activate template
    $data = array('Mailbox' => $Mailbox);
    $TSunic->Tmpl->activate('$$$showAddMailbox', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDMAILBOX__TITLE}'));

    return true;
}
?>
