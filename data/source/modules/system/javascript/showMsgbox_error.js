<!-- | JSFUNCTION show error messagebox -->
function $$$showMsgbox_error (headertext, errortext) {

    // create divs
    newdivs = $$$showMsgbox(headertext, errortext);

    // set style of box
    newdivs['box'].className = 'ts_js_msgbox_error';
    newdivs['header'].className = 'ts_js_msgbox_error_header';
    newdivs['content'].className = 'ts_js_msgbox_error_content';

    return newdivs;
}
