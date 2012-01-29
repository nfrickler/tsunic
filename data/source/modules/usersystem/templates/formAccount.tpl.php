<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/formAccount.tpl.php
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
$Account = $this->getVar('Account');
?>
<div id="$$$div__formAccount">
	<form action="<?php $this->setUrl('$$$editAccount'); ?>" method="post" name="$$$formAccount__form" id="$$$formAccount__form" class="ts_form">
	    <fieldset>
	        <legend><?php echo $this->set('{FORMACCOUNT__LEGEND}'); ?></legend>
	        <label for="$$$formAccount__email"><?php echo $this->set('{FORMACCOUNT__EMAIL}'); ?></label>
	        <input type="text" class="ts_required" name="$$$formAccount__email" id="$$$formAccount__email" value="<?php $this->setPreset('$$$formAccount__email', $TSunic->CurrentUser->getInfo('email')); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$formAccount__password"><?php echo $this->set('{FORMACCOUNT__PASSWORD}'); ?></label>
	        <input type="password" name="$$$formAccount__password" id="$$$formAccount__password" />
	        <div style="clear:both;"></div>
	        <label for="$$$formAccount__passwordrepeat"><?php echo $this->set('{FORMACCOUNT__PASSWORDREPEAT}'); ?></label>
	        <input type="password" name="$$$formAccount__passwordrepeat" id="$$$formAccount__passwordrepeat" />
	        <div style="clear:both;"></div>
	    </fieldset>
	    <input type="submit" class="ts_submit" value="<?php $this->set('{FORMACCOUNT__SUBMIT}'); ?>" />
	    <input type="reset" class="ts_reset" value="<?php $this->set('{FORMACCOUNT__RESET}'); ?>" />
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formAccount__allInputs = new Array();
	$$$formAccount__allInputs[0] = new Array('$$$formAccount__email',
														'<?php $this->setjs('{FORMACCOUNT__EMAIL_PRESET}'); ?>',
														'<?php $this->setjs('{FORMACCOUNT__EMAIL_HELP}'); ?>');
	$$$formAccount__allInputs[1] = new Array('$$$formAccount__password',
														'*******',
														'<?php $this->setjs('{FORMACCOUNT__PASSWORD_HELP}'); ?>');
	$$$formAccount__allInputs[2] = new Array('$$$formAccount__passwordrepeat',
														'*******',
														'<?php $this->setjs('{FORMACCOUNT__PASSWORDREPEAT_HELP}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formAccount__form'), $$$formAccount__allInputs);
</script>