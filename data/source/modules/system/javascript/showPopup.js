<!-- | js-function to create popup-box -->
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			javascript/showPopup.js
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

function $$$showPopup (header, text, buttontext) {

	// create (darkend-)background
	var background = document.createElement('div');
	document.body.appendChild(background);
	background.className = 'ts_js_blackbg';

	// create popup-box
	var popup = document.createElement('div');
	document.body.appendChild(popup);

	// add header
	var popupheader = document.createElement('div');
	popup.appendChild(popupheader);

	// add header_in
	var popupheader_in = document.createElement('p');
	var headercontent = document.createTextNode(header);
	popupheader_in.appendChild(headercontent);
	popupheader.appendChild(popupheader_in);

	// add content
	var popupcontent = document.createElement('p');
	popup.appendChild(popupcontent);

	// add content_in
	var popupcontent_in = document.createElement('div');
	var contentcontent = document.createTextNode(text);
	popupcontent_in.appendChild(contentcontent);
	popupcontent.appendChild(popupcontent_in);

	// add button
	var popupbutton = document.createElement('div');
	popupcontent.appendChild(popupbutton);

	// add button_in
	var popupbutton_in = document.createElement('button');
	var buttoncontent = document.createTextNode(buttontext);
	popupbutton_in.appendChild(buttoncontent);
	popupbutton.appendChild(popupbutton_in);

	// set style of box
	popup.className = 'ts_js_popup';

	// add clearing of popup
	popup.onclick = function(){
		// remove background
		$$$removeElement(background);
		// remove popup
		$$$removeElement(popup);
	}

	// set focus on button
	popupbutton_in.focus();

	// get return
	var output = new Array();
	output['popup'] = popup;
	output['header'] = popupheader;
	output['header_in'] = popupheader_in;
	output['content'] = popupcontent;
	output['content_in'] = popupcontent_in;
	output['background'] = background;
	output['button'] = popupbutton;
	output['button_in'] = popupbutton_in;
	return output;
}