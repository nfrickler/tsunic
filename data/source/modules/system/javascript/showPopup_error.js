<!-- | -->
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
