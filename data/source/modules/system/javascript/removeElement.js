<!-- | js-function to remove elements -->
function $$$removeElement (object) {

    // check, if element exists
    if (!object) {
	return true;
    }

    // get childs of object
    var childElements = object.childNodes;

    // remove child elements
    for (var i = 0; i < childElements.length; i++) {
	$$$removeElement(childElements.item(i));
    }

    // remove element
    object.parentNode.removeChild(object);

    return true;
}
