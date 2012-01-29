<!-- | TEMPLATE - show page (main template) -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/html.tpl.php
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-cache" />
	<title><?php $this->setVar('title'); ?> | TSunic 4.1</title>
	<link rel="stylesheet" type="text/css" href="<?php $this->setVar('path_format'); ?>" />
	<script type="text/javascript" src="runtime/javascript/$$$jQuery.js"></script>
</head>
<body>
	<div id="div_tsunic">
		<div id="$$$div__left">
			&nbsp;
		</div>
		<div id="$$$div__center">
			<?php $this->display('$$$header'); ?>
			<?php $this->display('$$$content'); ?>
			<?php $this->display('$$$navigation_header'); ?>
			<?php $this->display('$$$footer'); ?>
		</div>
		<?php $this->display('$navigation__tsuniccoremodule$show'); ?>
	</div>
	<?php $this->display('$$$settings'); ?>
	<?php $this->display('$$$includeJavascript'); ?>
</body>
</html>