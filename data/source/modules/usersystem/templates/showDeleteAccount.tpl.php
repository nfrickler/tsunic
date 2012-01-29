<!-- | TEMPLATE delete account? -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/showDeleteAccount.tpl.php
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

// get data
$User = $this->getVar('User');
?>
<div id="$$$div__showdeleteAccount">
	<h1><?php $this->set('{SHOWDELETEACCOUNT__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWDELETEACCOUNT__INFOTEXT}'); ?>
	</p>
	<form action="<?php $this->setUrl('$$$deleteAccount'); ?>" method="post" name="$$$showDeleteAccount__form" id="$$$showDeleteAccount__form" class="ts_form">
	    <fieldset>
	        <legend><?php echo $this->set('{SHOWDELETEACCOUNT__LEGEND}'); ?></legend>
	        <label for="$$$showDeleteAccount__password"><?php echo $this->set('{SHOWDELETEACCOUNT__PASSWORD}'); ?></label>
	        <input type="password" name="$$$showDeleteAccount__password" id="$$$showDeleteAccount__password" class="ts_input" />
	        <div style="clear:both;"></div>
	    </fieldset>
	    <input type="submit" class="ts_submit" value="<?php echo $this->set('{SHOWDELETEACCOUNT__SUBMIT}'); ?>" />
	</form>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAccount'); ?>">
			<?php $this->set('{SHOWDELETEACCOUNT__TOSHOWACCOUNT}'); ?></a>
	</p>
</div>
<script type="text/javascript">

	// set default values
	$system$setInputDefault(document.getElementById('$$$showDeleteAccount__password'), '*******');

	// add events
	document.getElementById('$$$showDeleteAccount__password').onfocus = function(){$system$clearInput(this, '*******');};
	document.getElementById('$$$showDeleteAccount__password').onblur = function(){$system$setInputDefault(this, '*******');};

	// focus on password
	document.getElementById('$$$showDeleteAccount__password').focus();
</script>