<!-- | function to show form to add new mail account -->
<?php
function $$$showAddMailaccount () {
    global $TSunic;

    // get empty Mailaccount object
    $Mailaccount = $TSunic->get('$$$Mailaccount');

    // activate template
    $data = array('Mailaccount' => $Mailaccount);
    $TSunic->Tmpl->activate('$$$showAddMailaccount', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDMAILACCOUNT__TITLE}'));

    return true;
}
?>
