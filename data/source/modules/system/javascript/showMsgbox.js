<!-- | JSFUNCTION show msgbox -->
function $$$showMsgbox (header, text) {

    // create outer box
    var outer = document.createElement('div');
    document.body.appendChild(outer);

    // create inner box
    var inner = document.createElement('div');
    outer.appendChild(inner);

    // add header
    var popupheader = document.createElement('div');
    var headercontent = document.createTextNode(header);
    popupheader.appendChild(headercontent);
    inner.appendChild(popupheader);

    // add content
    var popupcontent = document.createElement('p');
    var contentcontent = document.createTextNode(text);
    popupcontent.appendChild(contentcontent);
    inner.appendChild(popupcontent);

    // set style of box
    outer.className = 'ts_js_msgbox';

    // add clearing of popup
    inner.onclick = function(){
	// remove popup
	$$$removeElement(inner);
    }

    // get return
    var output = new Array();
    output['outerbox'] = outer;
    output['box'] = inner;
    output['header'] = popupheader;
    output['content'] = popupcontent;
    return output;
}
