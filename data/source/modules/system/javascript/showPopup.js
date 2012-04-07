<!-- | js-function to create popup-box -->
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
