<!-- | javascript function to show info popup -->
function $$$showPopup_info (headertext, infotext, buttontext) {

	// add box
	newdivboxes = $$$showPopup(headertext, infotext, buttontext);

	// set style of box
	newdivboxes['header'].className = 'ts_js_popup_info_header';
	newdivboxes['header_in'].className = 'ts_js_popup_info_header_in';
	newdivboxes['content'].className = 'ts_js_popup_info_content';
	newdivboxes['content_in'].className = 'ts_js_popup_info_content_in';
	newdivboxes['button'].className = 'ts_js_popup_button_in';
	newdivboxes['button_in'].className = 'ts_submit';

	return newdivboxes;
}
