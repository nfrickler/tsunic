<!-- | js-function to reset input-fields -->
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			javascript/resetInput.js
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

function $$$resetInput (object, defaultValue, refill) {

	// set default refill
	if (refill === undefined) refill = true;
	if (refill == true) {
		// set value
		object.value = defaultValue;
		// change style
		object.style.color = '#999';
	} else {
		// set empty value
		object.value = '';
	}

	return true;
}