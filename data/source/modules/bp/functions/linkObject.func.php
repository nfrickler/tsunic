<!-- | FUNCTION create new Link between objects -->
<?php
function $$$linkObject () {
    global $TSunic;

    // get input
    $fk_obj = $TSunic->Input->uint('$$$formLinkObject__fk_obj');
    $obj2link = $TSunic->Input->uint('$$$formLinkObject__obj2link');
    $backlink = base64_decode(
	$TSunic->Input->post('$$$formChooseObject__backlink'));
    if (!$backlink) $backlink = '?back=2';

    // get Object
    $Object = $TSunic->get('$$$BpObject', $fk_obj);

    // create new Link
    $Link = $TSunic->get('$$$Link');
    if (!$Link->create($fk_obj, $obj2link, false, false)) {
	$TSunic->Log->alert('error', '{LINKOBJECT__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{LINKOBJECT__SUCCESS}');
    $TSunic->redirect($backlink, true);
    return true;
}
?>
