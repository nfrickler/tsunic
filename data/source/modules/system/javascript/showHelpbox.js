<!-- | -->
function $$$showHelpbox (beforeObject, helptext, cssclass) {

    // reject if no helptext
    if (!helptext) return;

    // get default css-class
    if (cssclass === undefined) cssclass = 'ts_input_help';

    // create helpbox
    var helpbox = document.createElement('p');
    var content = document.createTextNode(helptext);
    helpbox.appendChild(content);

    // insert in document
    $(helpbox).insertAfter(beforeObject);

    // add css-class
    helpbox.className = cssclass;
    return helpbox;
}
