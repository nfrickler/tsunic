<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/html.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; main-template file
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

// deny direct access
defined('TS_INIT') OR die('Access denied!');

// global values
global $Config;
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="cache-control" content="no-cache" />
	<title><?php $this->setVar('title'); ?> | TSunic <?php echo $Config->get('version'); ?></title>
	<link rel="stylesheet" type="text/css" href="format.css" />
</head>
<body>
	<?php if (!empty($_SESSION['admin_info'])) { ?>
	<div id="div_info">
		<?php $this->set($_SESSION['admin_info']); ?>
	</div>
	<?php unset($_SESSION['admin_info']); } ?>
	<?php if (!empty($_SESSION['admin_error'])) { ?>
	<div id="div_error">
		<?php $this->set($_SESSION['admin_error']); ?>
	</div>
	<?php unset($_SESSION['admin_error']); } ?>

	<?php if (isset($_SESSION['admin_auth']) AND !empty($_SESSION['admin_auth']) AND $Config->get('installation') <= 100 AND $Config->get('installation_progress')) { ?>
	<?php
		$event_next = '';
		foreach ($Config->get('installation_progress') as $index => $value) {
			if (!$value) {
				$event_next = $index;
				switch ($event_next) {
					case 'setLogin':
						$event_next = 'showSetLogin';
						break;
					case 'setConfig':
						$event_next = 'showConfig';
						break;
					case 'setStyles':
						$event_next = 'showStyles';
						break;
					case 'parseAll':
						$event_next = 'showModules';
						break;
				}
				break;
			}
		}
	?>
	<div id="div_progress">
		<div id="div_progress_in" style="width:<?php echo $Config->get('installation'); ?>%;"></div>
		<div id="div_progress_tag">
			<?php $this->set('HTML__INSTALLATIONPROGRESS'); ?> | <?php echo ((int) $Config->get('installation')); ?>%
		</div>
		<div id="div_progress_link">
			<a href="?event=<?php echo $event_next ?>"><?php $this->set('HTML__INSTALLATION_NEXT'); ?></a>
		</div>
	</div>
	<?php } ?>
	<div id="div_tsunic">
		<div id="div_navig">
			<ul>
				<?php if (isset($_SESSION['admin_auth']) AND !empty($_SESSION['admin_auth'])) { ?>
				<li><a href="?"><?php $this->set('HTML__INDEX'); ?></a></li>
				<li><a href="?event=showModules"><?php $this->set('HTML__MODULES'); ?></a></li>
				<li><a href="?event=showStyles"><?php $this->set('HTML__STYLES'); ?></a></li>
				<li><a href="?event=showConfig"><?php $this->set('HTML__CONFIG'); ?></a></li>
				<li><a href="?event=showTools"><?php $this->set('HTML__TOOL'); ?></a></li>
				<li><a href="?event=doLogout"><?php $this->set('HTML__LOGOUT'); ?></a></li>
				<?php } else { ?>
				<li><a href="?"><?php $this->set('HTML__LOGIN'); ?></a></li>
				<?php } ?>
			</ul>
			<div style="clear:both;"></div>
		</div>
		<?php $this->display(false); ?>
		<div id="div_footer">
			<p style="border-bottom:1px dashed #FFF; margin-bottom:10px;">
				<a href="?event=<?php echo $_GET['event']; ?>&amp;lang=en">English</a>
				| <a href="?event=<?php echo $_GET['event']; ?>&amp;lang=de">Deutsch</a>
			</p>
			Powered by <a href="http://tsunic.de" target="_blank">TSunic <?php echo $Config->get('version'); ?></a> <br />
			Copyright ©2011 Nicolas Frinker
		</div>
	</div>
	<div class="div_tsunic_topright">
		<a href="../" target="_blank">
			<img src="templates/images/tsunic4_logo_4.1.png" alt="TSunic Logo" style="width:80px; height:80px;" /></a>
	</div>
</body>
</html>
