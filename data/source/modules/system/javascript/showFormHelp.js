<!-- | javascript function to show help boxes in forms -->
function $$$showFormHelp (formobject, inputobjects, cancelurl) {

	// add reset
	formobject.onreset = function(){
		// check, if redirect or reset
		if (!cancelurl) {
			// reset
			// empty all inputs
			$.each(inputobjects, function() {
				$$$resetInput(document.getElementById(this[0]), this[1]);
			});
		} else {
			// redirect
			// redirect
			location.href= cancelurl;
		}
		return false;
	}

	// add submit
	formobject.onsubmit = function(){
		// clear all empty fields
		$.each(inputobjects, function() {
			$$$clearInput(document.getElementById(this[0]), this[1], false);
		});
		return true;
	}

	// add events to input-fields
	$.each(inputobjects, function() {

		// get values
		var object = document.getElementById(this[0]);
		var preset = this[1];
		var helptext = this[2];
		var idname = this[0];
		var helpboxes = new Array();

		// add events to input
		object.onfocus = function(){
			helpboxes[idname] = $$$showHelpbox(this, helptext);
			$$$clearInput(object, preset);
		};
		object.onblur = function(){
			$$$removeElement(helpboxes[idname]);
			$$$setInputDefault(object, preset);
		};

		// set preset
		$$$setInputDefault(object, preset);
	});
	return true;
}
