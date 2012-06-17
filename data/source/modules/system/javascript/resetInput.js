<!-- | js-function to reset input-fields -->
function $$$resetInput (object, defaultValue, refill) {

    // set default refill
    if (refill === undefined) refill = true;
    if (refill == true) {
	// set value
	object.value = defaultValue;
	// change style
	object.style.color = '#999';
    } else {
	// set empty value
	object.value = '';
    }

    return true;
}
