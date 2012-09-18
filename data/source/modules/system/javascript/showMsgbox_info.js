<!-- | JSFUNCTION show info msgbox -->
function $$$showMsgbox_info (headertext, infotext) {

    // create divs
    newdivs = $$$showMsgbox(headertext, infotext);

    // set style of box
    newdivs['box'].className = 'ts_js_msgbox_info';
    newdivs['header'].className = 'ts_js_msgbox_info_header';
    newdivs['content'].className = 'ts_js_msgbox_info_content';

    return newdivs;
}
