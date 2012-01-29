<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showDeleteMailbox.tpl.php
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

$mailbox = $this->getVar('mailbox');
?>
<div id="div_mail__showDeleteMailbox">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETEMAILBOX__POPUP_DELETE_HEADER}', array('name' => $mailbox->getInfo('name')), false),
													   'contenttext' => '{SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT}',
													   'submittext' => '{SHOWDELETEMAILBOX__POPUP_DELETE_YES}',
													   'canceltext' => '{SHOWDELETEMAILBOX__POPUP_DELETE_NO}',
													   'submit_href' => $this->setUrl('$$$deleteMailbox', array('id_mail__box' => $mailbox->getInfo('id_mail__box')), true, false),
													   'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>