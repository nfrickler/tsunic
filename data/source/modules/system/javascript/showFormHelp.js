<!-- | -->
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			javascript/showFormHelp.js
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