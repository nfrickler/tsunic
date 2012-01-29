<!-- | -->
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			javascript/showHelpbox.js
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

function $$$showHelpbox (beforeObject, helptext, cssclass) {

	// get default css-class
	if (cssclass === undefined) cssclass = 'ts_input_help';

	// create helpbox
	var helpbox = document.createElement('p');
	var content = document.createTextNode(helptext);
	helpbox.appendChild(content);

	// insert in document
	$(helpbox).insertAfter(beforeObject);

	// add css-class
	helpbox.className = cssclass;
	return helpbox;
}