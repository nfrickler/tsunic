<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showSendMail.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

// get input
$Mail = $this->getVar('Mail');
$smtps = $this->getVar('smtps');
?>
<div id="$$$div__showSendMail">
	<h1><?php $this->set('{SHOWSENDMAIL__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWSENDMAIL__INFO}'); ?></p>
	<form action="<?php $this->setUrl('$$$sendMail'); ?>" method="post" id="$$$showSendMail__form" class="ts_form">
		<input type="hidden" name="$$$showSendMail__id_mail_mail" id="$$$showSendMail__id_mail_mail" value="<?php $this->set($Mail->getInfo('id_mail__mail')); ?>" />
	    <fieldset>
	        <legend><?php echo $this->set('{SHOWSENDMAIL__LEGEND_HEADER}'); ?></legend>
	        <label for="$$$showSendMail__id_mail__smtp"><?php echo $this->set('{SHOWSENDMAIL__SENDER}'); ?></label>
			<select class="ts_required" name="$$$showSendMail__id_mail__smtp" id="$$$showSendMail__id_mail__smtp">
				<?php foreach ($smtps as $index => $value) { ?>
				<option value="<?php $this->set($value->getInfo('id_mail__smtp')); ?>" <?php if($this->setPreset('$$$showSendMail__id_mail__smtp', false, false) == $value->getInfo('id_mail__smtp')) echo 'selected="selected"'; ?>>
					<?php $this->set($value->getInfo('emailname')); ?> &lt;<?php $this->set($value->getInfo('email')); ?>&gt;
				</option>
				<?php } ?>
			</select>
	        <div style="clear:both;"></div>
	        <label for="$$$showSendMail__addressee"><?php echo $this->set('{SHOWSENDMAIL__ADDRESSEE}'); ?></label>
	        <input type="text" name="$$$showSendMail__addressee" id="$$$showSendMail__addressee" class="ts_required" value="<?php $this->setPreset('$$$showSendMail__addressee', $Mail->getInfo('addressee')); ?>" />
	        <div style="clear:both;"></div>
		</fieldset>
	    <fieldset>
	        <legend><?php echo $this->set('{SHOWSENDMAIL__LEGEND_CONTENT}'); ?></legend>
	        <label for="$$$showSendMail__subject"><?php echo $this->set('{SHOWSENDMAIL__SUBJECT}'); ?></label>
	        <input type="text" name="$$$showSendMail__subject" id="$$$showSendMail__subject" class="ts_required" value="<?php $this->setPreset('$$$showSendMail__subject', $Mail->getInfo('subject')); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$showSendMail__content"><?php echo $this->set('{SHOWSENDMAIL__CONTENT}'); ?></label>
	        <textarea rows="8" name="$$$showSendMail__content" id="$$$showSendMail__content" class="ts_required" style="height:auto;"><?php $this->setPreset('$$$showSendMail__content', $Mail->getInfo('content')); ?></textarea>
	        <div style="clear:both;"></div>
		</fieldset>
	    <input type="submit" class="ts_submit" value="<?php $this->set('{SHOWSENDMAIL__SUBMIT}'); ?>" />
	    <input type="reset" class="ts_reset" value="<?php $this->set('{SHOWSENDMAIL__RESET}'); ?>" />
	</form>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
			<?php $this->set('{SHOWSENDMAIL__TOSHOWMAILBOXES}'); ?></a>
	</p>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$showSendMail__allInputs = new Array();
	$$$showSendMail__allInputs[0] = new Array('$$$showSendMail__id_mail__smtp',
												 false,
												 '<?php $this->set('{SHOWSENDMAIL__SENDER_HELP}'); ?>');
	$$$showSendMail__allInputs[1] = new Array('$$$showSendMail__addressee',
												 '<?php $this->set('{SHOWSENDMAIL__ADDRESSEE_PRESET}'); ?>',
												 '<?php $this->set('{SHOWSENDMAIL__ADDRESSEE_HELP}'); ?>');
	$$$showSendMail__allInputs[2] = new Array('$$$showSendMail__content',
												 '<?php $this->set('{SHOWSENDMAIL__CONTENT_PRESET}'); ?>',
												 '<?php $this->set('{SHOWSENDMAIL__CONTENT_HELP}'); ?>');
	$$$showSendMail__allInputs[3] = new Array('$$$showSendMail__subject',
												 '<?php $this->set('{SHOWSENDMAIL__SUBJECT_PRESET}'); ?>',
												 '<?php $this->set('{SHOWSENDMAIL__SUBJECT_HELP}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$showSendMail__form'), $$$showSendMail__allInputs);

</script>