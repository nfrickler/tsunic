<!-- | CLASS Image -->
<?php
/** Image file in TSunics filesystem
 *
 * This class represents an image file in TSunics filesystem
 */
class $$$Image extends $$$File {

    /** Image extensions
     * @var array $image_ext
     */
    protected $image_ext = array('jpg', 'jpeg', 'gif', 'png');

    /** Is file extension of name an image?
     * @param string $name
     *	Filename
     *
     * @return bool
     */
    public function isImage ($name) {
	$name = substr(strrchr($name, '.'),1);
	return in_array($name, $this->image_ext);
    }
}
?>
