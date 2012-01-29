<!-- | -->
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			javascript/showOptionbox.js
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

function $$$showOptionbox (headertext, contenttext, choice1, choice2) {

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
	var headercontent = document.createTextNode(headertext);
	popupheader_in.appendChild(headercontent);
	popupheader.appendChild(popupheader_in);

	// add content
	var popupcontent = document.createElement('p');
	popup.appendChild(popupcontent);

	// add content_in
	var popupcontent_in = document.createElement('div');
	var contentcontent = document.createTextNode(contenttext);
	popupcontent_in.appendChild(contentcontent);
	popupcontent.appendChild(popupcontent_in);

	// add buttondiv
	var popupbuttondiv = document.createElement('div');
	popupcontent.appendChild(popupbuttondiv);

	// add button1
	var popupbutton1 = document.createElement('button');
	var buttoncontent1 = document.createTextNode(choice1);
	popupbutton1.appendChild(buttoncontent1);
	popupbuttondiv.appendChild(popupbutton1);

	// add button1
	var popupbutton2 = document.createElement('button');
	var buttoncontent2 = document.createTextNode(choice2);
	popupbutton2.appendChild(buttoncontent2);
	popupbuttondiv.appendChild(popupbutton2);

	// add clearing-event of popup
	popup.onclick = function(){
		// remove background
		$$$removeElement(background);
		// remove popup
		$$$removeElement(popup);
	};

	// set standard-css-classes
	popup.className = 'ts_js_popup';
	popupheader.className = 'ts_popupbox_header';
	popupheader_in.className = 'ts_popupbox_header_in';
	popupcontent.className = 'ts_popupbox_content';
	popupcontent_in.className = 'ts_popupbox_content_in';
	popupbuttondiv.className = 'ts_popupbox_buttondiv';
	popupbutton1.className = 'ts_submit';
	popupbutton2.className = 'ts_cancel';

	// set focus on button2
	popupbutton2.focus();

	// get return
	var output = new Array();
	output['popup'] = popup;
	output['header'] = popupheader;
	output['header_in'] = popupheader_in;
	output['content'] = popupcontent;
	output['content_in'] = popupcontent_in;
	output['background'] = background;
	output['buttondiv'] = popupbuttondiv;
	output['button1'] = popupbutton1;
	output['button2'] = popupbutton2;
	return output;
}