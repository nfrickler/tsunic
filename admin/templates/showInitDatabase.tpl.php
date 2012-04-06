<!-- | template to show page to initialize database -->
<?php
// deny direct access
defined('TS_INIT') OR die('Access denied!');

// try to access database
global $Database;
$Database->isTable('#__modules');

?>
<h1><?php $this->set('SHOWINITDATABASE__H1'); ?></h1>
<p>
	<?php $this->set('SHOWINITDATABASE__INFOTEXT'); ?>
</p>
<p style="text-align:center; border:1px dashed #AAA; margin:20px;">
<?php if ($Database->isTable('#__modules')) { ?>
	<?php $this->set('SHOWINITDATABASE__DONE'); ?><br /><br />
	<img src="templates/images/good.gif" alt="Done" />
<?php } else { ?>
	<?php $this->set('SHOWINITDATABASE__ERROR'); ?><br /><br />
	<img src="templates/images/bad.gif" alt="Error" /><br /><br />
	<a href="?event=showInitDatabase"><?php $this->set('SHOWINITDATABASE__ERROR_LINK'); ?></a>
<?php } ?>
</p>
