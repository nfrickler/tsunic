<!-- | TEMPLATE show bit -->
<?php
$Bit = $this->getVar('Bit');
$fk_obj = $this->getVar('fk_obj');
$Tag = (isset($Bit)) ? $Bit->getTag() : $this->getVar('Tag');
$typename = $Tag->getType()->getInfo('name');
$backlink = $this->getVar('backlink');

?>
    <td>
	<?php $this->set($Bit->get2show()); ?>
<?php

if (substr($typename,0,3) == 'fk_') {
$value = $Bit->getInfo('value');
?>
	<a href="<?php $this->setUrl('$$$showEditObject', array('$$$id' => $fk_obj, 'fk_bit' => $Bit->getInfo('id'), '$$$backlink' => $backlink)); ?>">
	    <?php $this->set('{SHOWBIT__TOEDITOBJECT}'); ?></a>
	<?php if (!empty($value)) { ?>
	<a href="<?php $this->setUrl('$$$showDeleteObject', array('$$$id' => $value, '$$$backlink' => $backlink)); ?>">
	    <?php $this->set('{SHOWBIT__TODELETEOBJECT}'); ?></a>
	<?php } ?>
	<a href="<?php $this->setUrl('$$$unlinkTag', array('$$$id' => $Bit->getInfo('id'), '$$$backlink' => $backlink)); ?>">
	    <?php $this->set('{SHOWBIT__TOUNLINKTAG}'); ?></a>
<?php } ?>
    </td>
