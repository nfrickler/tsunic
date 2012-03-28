<!-- | -->
<?php

// add javascript
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$Mailbox = $this->getVar('Mailbox');
$mailboxes = $this->getVar('mailboxes');
$mails = $Mailbox->getMails();
?>
<div id="$$$div__showMailbox">
	<h1><?php $this->set('{SHOWMAILBOX__H1}', array('name' => $Mailbox->getInfo('name'))); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showMailboxes'); ?>"><?php $this->set('{SHOWMAILBOX__TOSHOWMAILBOXES}'); ?></a>
	</p>
	<?php if (count($mails) > 0) { ?>
	<p class="ts_infotext">
		<?php $this->set('{SHOWMAILBOX__NUMBEROFMAILS}'); ?> <?php echo $Mailbox->getNumber(); ?>
	</p>
	<form action="<?php $this->setUrl('$$$performMailsAction'); ?>" method="post" id="$$$showMailbox__form">
		<input type="hidden" name="$$$showMailbox__submittype" id="$$$showMailbox__submittype" value="" />
		<table cellspacing="1" cellpadding="5" border="0">
			<tr style="width:100%;">
				<th style="min-width:10px;">&nbsp;</th>
				<th style="min-width:10px;">&nbsp;</th>
				<th style="min-width:300px;"><?php $this->set('{SHOWMAILBOX__SUBJECT}'); ?></th>
				<th style="width:120px;"><?php $this->set('{SHOWMAILBOX__FROMADDRESS}'); ?></th>
			</tr>
			<?php foreach ($mails as $index => $mail) { ?>
			<?php $bg_color = ($mail->isUnseen()) ? '#EEE' : '#DDD';  ?>
			<tr style="background:<?php echo $bg_color; ?>; margin:1px; padding:5px;">
				<td>
					<input type="checkbox" name="$$$showMailbox__selectedMails[]" value="<?php $this->set($mail->getInfo('id_mail__mail')); ?>" />
				</td>
				<td>
					<?php $attachments = $mail->getAttachments(); ?>
					<?php if (!empty($attachments)) { ?>
						<img src="<?php $this->setImg('project', '$$$attachment.png'); ?>" alt="A" style="width:16px; height:20px;" />
					<?php } ?>
					&nbsp;
				</td>
				<td>
					<a href="<?php $this->setUrl('$$$showMail', array('id_mail__mail' => $mail->getInfo('id_mail__mail'))); ?>">
						<?php $this->set($mail->getInfo('subject')); ?>
					</a>
				</td>
				<td>
					<?php $this->set($mail->getInfo('sender')); ?>
				</td>
			</tr>
			<?php } ?>
		</table>
		<p id="$$$showMailbox__selectMails_container" style="display:none;">
			<a href="javascript:$$$showMailbox__selectAll();">
				<?php $this->set('{SHOWMAILBOX__SELECTALL}'); ?>
			</a>
			<a href="javascript:$$$showMailbox__unselectAll();">
				<?php $this->set('{SHOWMAILBOX__DESELECTALL}'); ?>
			</a>
		</p>
		<p>
			<img src="<?php $this->setImg('project', '$$$arrow_top2downright.gif'); ?>" style="" />
			<input type="submit" name="$$$showMailbox__submit_delete" value="<?php $this->set('{SHOWMAILBOX__PERFORMACTION_DELETE}'); ?>" />
		<!--	<input type="submit" name="$$$showMailbox__submit_spam" value="<?php $this->set('{SHOWMAILBOX__PERFORMACTION_SETSPAM}'); ?>" /> -->
			<?php if (count($mailboxes) > 0) { ?>
			<select name="$$$showMailbox__moveto" id="$$$showMailbox__moveto">
				<option value="0"><?php $this->set('{SHOWMAILBOX__PERFORMACTION_MOVE}'); ?></option>
				<?php foreach ($mailboxes as $index => $value) { ?>
				<option value="<?php $this->set($value->getInfo('id_mail__box')); ?>"><?php $this->set($value->getInfo('name')); ?></option>
				<?php } ?>
			</select>
			<input type="submit" class="ts_submit" id="$$$showMailbox__submit_move" name="$$$showMailbox__submit_move" value="<?php $this->set('{SHOWMAILBOX__PERFORMACTION_MOVE_SUBMIT}'); ?>" />
			<?php } ?>
		</p>
	</form>
	<?php } else { ?>
	<p>
		<?php $this->set('{SHOWMAILBOX__NOMAILINBOX}'); ?>
	</p>
	<?php } ?>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showSendMail'); ?>">
			<?php $this->set('{SHOWMAILBOX__TOSHOWWRITEMAIL}'); ?></a>
		<a href="<?php $this->setUrl('$$$updateMailbox',
				array('id_mail__box' => $Mailbox->getInfo('id_mail__box'),
				'force' => 'true')); ?>">
			<?php $this->set('{SHOWMAILBOX__TOUPDATEMAILBOX}'); ?></a>
	</p>
</div>

<script type="text/javascript">

	<?php $mails = $this->getVar('Mailbox')->getMails(); ?>
	<?php if (!empty($mails)) { ?>
	// global var
	var $$$showMailbox__checkboxes = document.getElementsByName('$$$showMailbox__selectedMails[]');

	// add "selectAll"-function
	function $$$showMailbox__selectAll () {

		// select all
		for (var i = 0; i < $$$showMailbox__checkboxes.length; i++) {
			$$$showMailbox__checkboxes[i].checked = true;
		}

		return;
	}

	// add "unselectAll"-function
	function $$$showMailbox__unselectAll () {

		// select all
		for (var i = 0; i < $$$showMailbox__checkboxes.length; i++) {
			$$$showMailbox__checkboxes[i].checked = false;
		}

		return;
	}

	<?php if (count($mailboxes) > 0) { ?>
	// move to
	document.getElementById('$$$showMailbox__moveto').onchange = function(){

		// set submit-type
		document.getElementById('$$$showMailbox__submittype').value = 'move';

		// submit form
		document.getElementById('$$$showMailbox__form').submit();
	};

	<?php } ?>
	<?php } ?>

	/* ****************************** update mailbox ******************** */

	// global vars
	var $$$showMailbox__updater_box;
	var $$$showMailbox__updater_image;
	var $$$showMailbox__updater_text;
	var $$$showMailbox__optionbox;

	function $$$showMailbox__resetUpdater () {

		// remove updater
		$system$removeElement($$$showMailbox__updater_box);

		// set timeout
		setTimeout('$$$showMailbox__checkForNewMails();', 240000);

		return true;	
	}

	function $$$showMailbox__failUpdater () {

		// set text
		$$$showMailbox__updater_text.innerHTML = '<?php $this->setjs('{SHOWMAILBOX__UPDATER_FAIL}'); ?>';

		// set timeout
		setTimeout('$$$showMailbox__resetUpdater();', 5000);

		return true;	
	}

	function $$$showMailbox__nonewmails () {

		// set text
		$$$showMailbox__updater_text.innerHTML = '<?php $this->setjs('{SHOWMAILBOX__UPDATER_NONEWMAILS}'); ?>';

		// set timeout
		setTimeout('$$$showMailbox__resetUpdater();', 5000);

		return true;	
	}

	function $$$showMailbox__checkForNewMails () {

		// show updater
		$$$showMailbox__updater_box = document.createElement('div');
		document.getElementById('$$$div__showMailbox').appendChild($$$showMailbox__updater_box);

		$$$showMailbox__updater_image = document.createElement('img');
		$$$showMailbox__updater_box.appendChild($$$showMailbox__updater_image);
		$$$showMailbox__updater_image.setAttribute('src', '<?php $this->setImg('project', '$$$updater.gif'); ?>');

		$$$showMailbox__updater_text = document.createElement('p');
		$$$showMailbox__updater_text_in = document.createTextNode('<?php $this->setjs('{SHOWMAILBOX__JS_UPDATER}'); ?>');
		$$$showMailbox__updater_text.appendChild($$$showMailbox__updater_text_in);
		$$$showMailbox__updater_box.appendChild($$$showMailbox__updater_text);
		$$$showMailbox__updater_image.setAttribute("style", "float: left;");
		$$$showMailbox__updater_text.setAttribute("style", "float: left;");
		$$$showMailbox__updater_box.setAttribute("style", "margin-top:20px;");

		// send ajax-request and check for mails
		var ajaxResponse = $.ajax({
			type: "GET",
			url: "ajax.php",
			async:true,
			data: "<?php $this->setUrl('$$$updateMailbox', array('id_mail__box' => $this->getVar('Mailbox')->getInfo('id_mail__box')), false, true, false); ?>",
			success: function(t){
     			$$$handleAjaxSuccess(t);
     		}
		});

		return true;
	}

	function $$$handleAjaxSuccess (ajaxResponse) {

		// get new data
		if (ajaxResponse) {

			// error occurred?
			var response_error = ajaxResponse.getElementsByTagName('error');

			if (response_error.length > 0) {
				// error occurred
				response_error = response_error[0];

				alert($.trim(response_error.textContent));

				$$$showMailbox__failUpdater();
				return false;
			}

			var newmails_cache = ajaxResponse.getElementsByTagName('newmails');
			if (newmails_cache.length < 1) {
				// no new mails
				$$$showMailbox__nonewmails();
				return true;
			}
			newmails_cache = newmails_cache[0];

			// get number of new mails
			var number_of_new_mails = $.trim(newmails_cache.textContent);

			// check, if new mails
			if (number_of_new_mails > 0) {

				// show optionbox
				$$$showMailbox__optionbox = $system$showOptionbox('<?php $this->setjs('{SHOWMAILBOX__OPTIONBOX_NEWMAILS_HEADER}'); ?>',
				'<?php $this->setjs('{SHOWMAILBOX__OPTIONBOX_NEWMAILS_CONTENT}'); ?>',
				'<?php $this->setjs('{SHOWMAILBOX__OPTIONBOX_NEWMAILS_YES}'); ?>',
				'<?php $this->setjs('{SHOWMAILBOX__OPTIONBOX_NEWMAILS_NO}'); ?>');

				// add events to optionbox-buttons
				$$$showMailbox__optionbox['button1'].onclick = function(){

					location.href='<?php $this->setUrl('$$$showMailbox', array('id_mail__box' => $Mailbox->getInfo('id_mail__box')), false); ?>';
				};

				$$$showMailbox__resetUpdater();
				return true;
			} else {
				// no new mails
				$$$showMailbox__nonewmails();
			}

			return true;
		}

		// update failed
		$$$showMailbox__failUpdater();
		return false;
	}

	<?php if (count($this->getVar('Mailbox')->getMails()) > 0) { ?>
	// show and hide buttons
	document.getElementById('$$$showMailbox__selectMails_container').style.display = 'block';
	$system$removeElement(document.getElementById('$$$showMailbox__submit_move'));

	<?php } ?>

	// check for new mails
	setTimeout('$$$showMailbox__checkForNewMails();', <?php echo ($Mailbox->timeToCheck() * 1000); ?>);

</script>
