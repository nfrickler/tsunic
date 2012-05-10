<!-- | FUNCTION show help for current page -->
<?php
function $$$showHelp () {
	global $TSunic;
	$lang = $TSunic->Usr->config('$system$language');

	// get page to show
	$page_arr = explode('__', $TSunic->Temp->getGet('$$$page'));
	$Helpfile = $TSunic->get('$system$File', "#runtime#help/".$page_arr[0]."__".$lang."__".$page_arr[1].".help.php");
	if (!$Helpfile->isValid()) {
		$Helpfile->setPath("#runtime#help/$$$".$lang."__index.help.php");
		if (!$Helpfile->isValid()) {
			$TSunic->Log->doLog(3, "Could not find index help page '".$Helpfile->getPath()."'!");
			$TSunic->redirect('$$$showMain');
			exit;
		}
	}

	// activate template
	$data = array('Helpfile' => $Helpfile);
	$TSunic->Tmpl->activate('$$$showHelp', '$system$content', $data);

	return true;
}
?>
