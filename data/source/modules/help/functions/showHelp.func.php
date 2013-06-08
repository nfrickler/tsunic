<!-- | FUNCTION show help for current page -->
<?php
function $$$showHelp () {
    global $TSunic;
    $lang = $TSunic->Usr->config('$system$language');

    // get page to show
    $page_arr = explode('__', $TSunic->Input->param('$$$page'));
    if (!$lang or !$page_arr or count($page_arr) != 2) {
	$TSunic->Log->alert('error', '{SHOWHELP__ERROR}');
	$TSunic->redirect('back');
    }
    $Helpfile = $TSunic->get('$system$File', "#runtime#help/".$page_arr[0]."__".$lang."__".$page_arr[1].".help.php");
    if (!$Helpfile) {
	$TSunic->Log->log(3, "help:showHelp: ERROR Invalid helpfile!");
	$TSunic->redirect('$$$showMain');
    }
    if (!$Helpfile->isValid()) {
	$Helpfile->setPath("#runtime#help/$$$".$lang."__nopagefound.help.php");
	if (!$Helpfile->isValid()) {
	    $TSunic->Log->log(3, "Could not find index help page '".$Helpfile->getPath()."'!");
	    $TSunic->redirect('$$$showMain');
	}
    }

    // get id of current module
    $mod_id = substr($page_arr[0], 3);
    if ($page_arr[1] == 'index') $mod_id = 0;

    // activate template
    $data = array(
	'Helpfile' => $Helpfile,
	'modid' => $mod_id
    );
    $TSunic->Tmpl->activate('$$$showHelp', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWHELP__TITLE}'));

    return true;
}
?>
