<!-- | TEMPLATE - show system-messages (error & info) -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/showLog.tpl.php
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

// add javascript-functions
$TSunic->Tmpl->addJSfunction('$$$showPopup_error');
$TSunic->Tmpl->addJSfunction('$$$showPopup_info');

// get input
$Log = $this->getVar('Log');
$errors = ($Log) ? $Log->get('error', true) : array();
$infos = ($Log) ? $Log->get('info', true) : array();
$warnings = ($Log) ? $Log->get('warning', true) : array();

// return errors
if (!empty($errors)) {
?>
<div id="$$$div__showMessages__error" class="div_error">
	<?php foreach ($errors as $index => $values) { ?>
	<p><?php $this->set($values); ?></p>
	<?php } ?>
</div>
<?php
}

// return infos
if (!empty($infos)) {
?>
<div id="$$$div__showMessages__info" class="div_info">
	<?php foreach ($infos as $index => $values) { ?>
	<p><?php $this->set($values); ?></p>
	<?php } ?>
</div>
<?php } ?>

<script type="text/javascript">

	<?php
	// show errors
	if (!empty($errors)) { ?>

	// get error-messages
	var $$$showMessages__errors = new Array();
	<?php foreach ($errors as $index => $value) { ?>
	$$$showMessages__errors[<?php echo $index; ?>] = '<?php $this->set($value); ?>';
	<?php } ?>

	// show error as js-popup
	if ($$$showMessages__errors.length > 0) {

		// remove error in html
		$$$removeElement(document.getElementById('$$$div__showMessages__error'));

		// show all messages
		$.each($$$showMessages__errors, function() {
			// get content
			var error_text = this;

			// add error-box
			$$$showPopup_error('<?php $this->set('{SHOWMESSAGES__ERROR}'); ?> ', error_text, '<?php $this->set('{SHOWMESSAGES__ERRORSUBMIT}'); ?>');
		});
	}

	<?php }
	// show infos
	if (!empty($infos)) { ?>

	// get info-messages
	var $$$showMessages__infos = new Array();
	<?php foreach ($infos as $index => $value) { ?>
	$$$showMessages__infos[<?php echo $index; ?>] = '<?php $this->set($value); ?>';
	<?php } ?>

	// show info as js-popup
	if ($$$showMessages__infos.length > 0) {

		// remove info in html
		$$$removeElement(document.getElementById('$$$div__showMessages__info'));

		// show all messages
		$.each($$$showMessages__infos, function() {

			// get content
			var info_text = this;

			// add error-box
			$$$showPopup_info('<?php $this->set('{SHOWMESSAGES__INFO}'); ?>', info_text, '<?php $this->set('{SHOWMESSAGES__INFOSUBMIT}'); ?>');
		});
	}
	<?php } ?>

</script>