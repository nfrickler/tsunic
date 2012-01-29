<!-- | TEMPLATE show form for local mailbox -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/formMailbox.tpl.php
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
$mailbox = $this->getVar('mailbox');
?>
<div id="$$$div__formMailbox">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formMailbox__form" id="$$$formMailbox__form" class="ts_form">
		<input type="hidden" name="$$$formMailbox__id_mail__box" id="$$$formMailbox__id_mail__box" value="<?php $this->set($mailbox->getInfo('id_mail__box')); ?>" />
	    <fieldset>
	        <legend><?php echo $this->set('{FORMMAILBOX__LEGEND}'); ?></legend>
	        <label for="$$$formMailbox__name"><?php echo $this->set('{FORMMAILBOX__NAME}'); ?></label>
	        <input class="ts_required" type="text" name="$$$formMailbox__name" id="$$$formMailbox__name" value="<?php $this->setPreset('$$$formMailbox__name', $mailbox->getInfo('name')); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$formMailbox__description"><?php echo $this->set('{FORMMAILBOX__DESCRIPTION}'); ?></label>
	        <textarea name="$$$formMailbox__description" id="$$$formMailbox__description"><?php $this->setPreset('$$$formMailbox__description', $mailbox->getInfo('description')); ?></textarea>
            <div style="clear:both;"></div>
	    </fieldset>
	    <input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	    <input type="reset" class="ts_reset" value="<?php $this->set('#reset_text#'); ?>" />
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formMailbox__allInputs = new Array();
	$$$formMailbox__allInputs[0] = new Array('$$$formMailbox__name',
												'<?php $this->setjs('{FORMMAILBOX__PRESET_NAME}'); ?>',
												'<?php $this->setjs('{FORMMAILBOX__HELP_NAME}'); ?>');
	$$$formMailbox__allInputs[1] = new Array('$$$formMailbox__description',
												'<?php $this->setjs('{FORMMAILBOX__PRESET_DESCRIPTION}'); ?>',
												'<?php $this->setjs('{FORMMAILBOX__HELP_DESCRIPTION}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formMailbox__form'), $$$formMailbox__allInputs);

</script>