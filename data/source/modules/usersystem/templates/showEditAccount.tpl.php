<!-- | TEMPLATE show form to edit account -->
<?php
// get data
$User = $this->getVar('User');
?>
<div id="$$$div__showEditAccount">
	<h1><?php $this->set('{SHOWEDITACCOUNT__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITACCOUNT__INFOTEXT}'); ?></p>
	<?php $this->display('$$$formAccount', array(
		'User' => $User,
		'submit_link' => '$$$editAccount',
		'submit_text' => '{SHOWEDITACCOUNT__SUBMIT}',
		'reset_text' => '{SHOWEDITACCOUNT__RESET}',
		'password_required' => false
	)); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAccount'); ?>">
			<?php $this->set('{SHOWEDITACCOUNT__TOSHOWACCOUNT}'); ?></a>
	</p>
</div>
