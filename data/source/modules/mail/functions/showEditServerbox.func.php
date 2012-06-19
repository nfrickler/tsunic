<!-- | function to show form to edit serverbox -->
<?php
function $$$showEditServerbox () {
    global $TSunic;

    // get Serverbox object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Serverbox = $TSunic->get('$$$Serverbox', $id);

    // create SuperMail-object
    $SuperMail = $TSunic->get('$$$SuperMail');

    // activate template
    $data = array(
	'Serverbox' => $Serverbox,
	'Mailaccount' => $Serverbox->getMailaccount(),
	'mailboxes' => $mailboxes = $SuperMail->getMailboxes()
    );
    $TSunic->Tmpl->activate('$$$showEditServerbox', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITSERVERBOX__TITLE}'));

    return true;
}
?>
