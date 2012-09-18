<!-- | js-function to create popup-box -->
function $$$showPopup (header, text, buttontext) {

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

    // set style of box
    popup.className = 'ts_js_popup';

    // add clearing of popup
    popup.onclick = function(){
	// remove background
	$$$removeElement(background);
	// remove popup
	$$$removeElement(popup);
    }

    // get return
    var output = new Array();
    output['popup'] = popup;
    output['header'] = popupheader;
    output['header_in'] = popupheader_in;
    output['content'] = popupcontent;
    output['content_in'] = popupcontent_in;
    return output;
}
