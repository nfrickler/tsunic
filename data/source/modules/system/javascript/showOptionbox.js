<!-- | javascript function to show popup boxes with yes and no -->
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
