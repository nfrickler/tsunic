<!-- | -->
<?php

// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$Mail = $this->getVar('mail');
$attachments = $Mail->getAttachments();
?>
<div id="$$$div__showMail">
	<h1><?php $this->set('{SHOWMAIL__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showMailbox', array('id_mail__box' => $Mail->getInfo('fk_mail__box'))); ?>">
			<?php $this->set('{SHOWMAIL__TOSHOWMAILBOX}'); ?></a>
	</p>

	<div class="$$$div__showMail__mail">
		<div class="$$$div__showMail_mailheader">
			<div class="$$$div__showMail__mailheader_subject">
				<?php $this->set($Mail->getInfo('subject')); ?>
			</div>
			<div class="$$$div__showMail__mailheader_right">
				<a href="<?php $this->setUrl('$$$showDeleteMail', array('id_mail__mail' => $Mail->getInfo('id_mail__mail'))); ?>" id="$$$showMail__delete">
					<img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWMAIL__DELETE}'); ?>" /></a>
			</div>
			<div style="clear:both;"></div>
			<table class="$$$div__showMail__mailheader_table">
				<tr>
					<th><?php $this->set('{SHOWMAIL__SENDER}'); ?></th>
					<td><?php $this->set($Mail->getInfo('sender')); ?></td>
				</tr>
				<tr>
					<th><?php $this->set('{SHOWMAIL__ADDRESSEE}'); ?></th>
					<td><?php $this->set($Mail->getInfo('addressee')); ?></td>
				</tr>
				<tr>
					<th><?php $this->set('{SHOWMAIL__DATEOFMAIL}'); ?></th>
					<td><?php $this->set($Mail->getInfo('dateOfMail')); ?></td>
				</tr>
			</table>
		</div>
		<iframe id="$$$div__showMail_mailcontent" class="$$$div__showMail_mailcontent" src="<?php $this->setUrl('$$$showMailContent', array('id_mail__mail' => $Mail->getInfo('id_mail__mail'), 'tmpl' => '$$$showMailContent')); ?>">
			<?php $this->set('{SHOWMAIL__NOIFRAMESUPPORT}'); ?>
			<a href="<?php $this->setUrl('$$$showMailContent', array('id_mail__mail' => $Mail->getInfo('id_mail__mail'), 'tmpl' => '$$$showMailContent')); ?>" target="_blank">
				<?php $this->set('{SHOWMAIL__NOIFRAMESUPPORT_OPENMAIL}'); ?></a>
		</iframe>
		<?php if (!empty($attachments)) { ?>
		<div class="$$$div__showMail__attachments">
			<h3><?php $this->set('{SHOWMAIL__ATTACHMENTS}'); ?></h3>
			<?php foreach ($attachments as $index => $Value) { ?>
			| <a href="<?php $this->setImg('private', $Value->getInfo('fk__usersystem__userfile'), true, true); ?>"><?php $this->set($Value->getInfo('name')); ?></a>
			<?php } ?>
		</div>
		<?php } ?>
	</div>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showSendMail', array('id_mail__mail' => $Mail->getInfo('id_mail__mail'))); ?>">
			<?php $this->set('{SHOWMAIL__ANSWERMAIL}'); ?></a>
	</p>
</div>

<script type="text/javascript">

	// get id_mail_mail
	var $$$showmail__id_mail__mail = <?php echo $this->getVar('mail')->getInfo('id_mail__mail'); ?>;

	// add delete-event
	var deleteLink = document.getElementById('$$$showMail__delete');
	deleteLink.onclick = function() {

		// create optionbox
		var allobjects = $system$showOptionbox('<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_HEADER_JS}'); ?>}',
			'<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_CONTENT}'); ?>',
			'<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_YES}'); ?>',
			'<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_NO}'); ?>');

		allobjects['button1'].onclick = function() {
			location.href = "<?php $this->setUrl('$$$deleteMail', array('id_mail__mail' => $this->getVar('mail')->getInfo('id_mail__mail')), false); ?>";
		};

		// reset onclick-event
		return false;
	};

	// calculate height of iframe
	function $$$showMails__calcHeight() {
		var myiframe = document.getElementById('$$$div__showMail_mailcontent');

		//find the height of the internal page
		var the_height = myiframe.contentWindow.document.body.scrollHeight;

		//change the height of the iframe
		myiframe.style.height = the_height + "px";
	}
	document.getElementById('$$$div__showMail_mailcontent').onLoad = $$$showMails__calcHeight();
</script>
