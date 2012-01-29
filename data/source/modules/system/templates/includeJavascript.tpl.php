<!-- | TEMPLATE - include all embedded javascript-code -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/includeJavascript.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

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