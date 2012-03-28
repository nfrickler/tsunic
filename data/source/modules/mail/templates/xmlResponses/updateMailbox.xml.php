<!-- | XML-TEMPLATE - update mailbox -->
<all>
	<success><?php $this->setVar('success'); ?></success>

	<newmails>
	<?php echo count($this->getVar('new_mails')); ?>
	</newmails>
</all>
