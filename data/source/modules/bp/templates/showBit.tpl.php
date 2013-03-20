<!-- | TEMPLATE show bit -->
<?php
$Bit = $this->getVar('Bit');
$fk_obj = $this->getVar('fk_obj');
$Tag = (isset($Bit)) ? $Bit->getTag() : $this->getVar('Tag');
$typename = $Tag->getType()->getInfo('name');
$backlink = $this->getVar('backlink');
$noTd = $this->getVar('noTd');
$value = $Bit->getInfo('value');

if (!$noTd) echo "<td>";

switch ($typename) {
    case 'timestamp':
	if (is_numeric($value)) echo date('d.m.Y H:i:s', $value);
	break;
    case 'date':
	if (is_numeric($value)) echo date('d.m.Y', $value);
	break;
    default:
	$this->set($Bit->get2show());
	break;
}

if (substr($typename,0,3) == 'mod') {
?>
    <a href="<?php $this->setUrl('$$$showChooseObject', array('$$$fk_bit' => $Bit->getInfo('id'), '$$$backlink' => $backlink)); ?>">
	<?php $this->set('{SHOWBIT__TOEDITOBJECT}'); ?></a>
    <?php if (!empty($value)) { ?>
    <a href="<?php $this->setUrl('$$$showDeleteObject', array('$$$id' => $value, '$$$backlink' => $backlink)); ?>">
	<?php $this->set('{SHOWBIT__TODELETEOBJECT}'); ?></a>
    <?php } ?>
    <a href="<?php $this->setUrl('$$$unlinkTag', array('$$$id' => $Bit->getInfo('id'), '$$$backlink' => $backlink)); ?>">
	<?php $this->set('{SHOWBIT__TOUNLINKTAG}'); ?></a>
    <?php } ?>
<?php
if (!$noTd) echo "</td>";
?>
