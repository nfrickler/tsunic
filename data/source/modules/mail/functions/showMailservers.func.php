<!-- | function to show mailservers -->
<?php
function $$$showMailservers () {
    global $TSunic;

    // get SuperMail-object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array(
	'mailaccounts' => $SuperMail->getMailaccounts(),
	'smtps' => $SuperMail->getSmtps(false)
    );
    $TSunic->Tmpl->activate('$$$showMailservers', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAILSERVERS__TITLE}'));

    return true;
}
?>
