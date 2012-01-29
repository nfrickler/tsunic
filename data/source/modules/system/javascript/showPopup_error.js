<!-- | -->
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			javascript/showPopup_error.js
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

function $$$showPopup_error (headertext, errortext, buttontext) {

	// add box
	newdivboxes = $$$showPopup(headertext, errortext, buttontext);

	// set style of box
	newdivboxes['header'].className = 'ts_js_popup_error_header';
	newdivboxes['header_in'].className = 'ts_js_popup_error_header_in';
    newdivboxes['content'].className = 'ts_js_popup_error_content';
    newdivboxes['content_in'].className = 'ts_js_popup_error_content_in';
    newdivboxes['button'].className = 'ts_js_popup_button_in';
    newdivboxes['button_in'].className = 'ts_submit';
	return newdivboxes;
}