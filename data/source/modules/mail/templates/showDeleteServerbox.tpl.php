<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showDeleteServerbox.tpl.php
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

$Serverbox = $this->getVar('Serverbox');
?>
<div id="$$$div__showDeleteServerbox">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETESERVERBOX__POPUP_DELETE_HEADER}', array('name' => $Serverbox->getInfo('name')), false),
													    'contenttext' => '{SHOWDELETESERVERBOX__POPUP_DELETE_CONTENT}',
													    'submittext' => '{SHOWDELETESERVERBOX__POPUP_DELETE_YES}',
													    'canceltext' => '{SHOWDELETESERVERBOX__POPUP_DELETE_NO}',
													    'submit_href' => $this->setUrl('$$$deleteServerbox', array('id_mail__serverbox' => $Serverbox->getInfo('id_mail__serverbox')), true, false),
													    'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>