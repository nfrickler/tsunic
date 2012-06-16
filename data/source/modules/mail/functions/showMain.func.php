<!-- | function to show main page -->
<?php
function $$$showMain () {
    global $TSunic;

    // get superMail-object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array('mailboxes' => $SuperMail->getMailboxes());
    $TSunic->Tmpl->activate('$$$showMain', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAIN__TITLE}'));

    return true;
}
?>
