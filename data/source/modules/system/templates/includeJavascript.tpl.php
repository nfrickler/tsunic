<!-- | TEMPLATE - include all embedded javascript-code -->
<?php

// check, if javascript is disabled (=return)
if ($TSunic->isJavascript(true) == 'off') return;

// add javascript
$TSunic->Tmpl->addJSfunction('$$$removeElement');
$TSunic->Tmpl->addJSfunction('$$$showPopup');
$TSunic->Tmpl->addJSfunction('$$$setInputDefault');
$TSunic->Tmpl->addJSfunction('$$$clearInput');
$TSunic->Tmpl->addJSfunction('$$$resetInput');
$TSunic->Tmpl->addJSfunction('$$$showHelpbox');
$TSunic->Tmpl->addJSfunction('$$$showFormHelp');

// get js-functions and -classes for include
$js_functions = $TSunic->Tmpl->getActivatedJavascript();
?>
<script type="text/javascript">
var $$$fkt_ready = 0;

// load main js-file (function.js.php)
function $$$startScript () {

    // all functions
    var all_functions = new Array();
    <?php
    $counter = 0;
    foreach ($js_functions as $index => $value) {
	$path = 'runtime/javascript/'.$value.'.js';
	echo 'all_functions['.$counter.'] = "'.$path.'";'."\n";
	$counter++;
    } ?>

    // load all functions
    for (var i = 0; i < all_functions.length; i++) {

	// load
	$.getScript(all_functions[i], function() {
	    $$$startReady();
	});
    }

    return true;
}

// check ready-status
function $$$startReady () {
    var fkt_number = <?php echo count($js_functions); ?>;

    // increase amount of ready functions
    $$$fkt_ready++;

    // check, if all functions ready
    if ($$$fkt_ready == fkt_number) {

	// load functions.js.php
	$.getScript('functions.js.php', function() {
	    // nothing to do
	});
    }
}

// start javascript
$$$startScript();

</script>
