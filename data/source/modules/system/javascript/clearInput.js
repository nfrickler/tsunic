<!-- | js-function to clear input-fields -->
function $$$clearInput (object, defaultValue) {

	// clear value
	if (object.value == defaultValue) {
		object.value = '';
	}

	// change style
	object.style.color = '#000';
	return true;
}
