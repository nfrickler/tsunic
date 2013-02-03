<!-- | CLASS Image -->
<?php
class $$$Image extends $$$File {

    /* image extensions
     * array
     */
    protected $image_ext = array('jpg', 'jpeg', 'gif', 'png');

    /* is file-extension of name an image?
     * @param string: filename
     *
     * @return bool
     */
    public function isImage ($name) {
	$name = substr(strrchr($name, '.'),1);
	return in_array($name, $this->image_ext);
    }
}
