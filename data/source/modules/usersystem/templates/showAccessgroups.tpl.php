<!-- | TEMPLATE show list of accessgroups -->
<div id="$$$div__showAccessgroups">
	<h1><?php $this->set('{SHOWACCESSGROUPS__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showCreateAccessgroup'); ?>">
			<?php $this->set('{SHOWACCESSGROUPS__TOCREATEACCESSGROUP}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWACCESSGROUPS__INFOTEXT}'); ?>
	</p>

	<?php
	/* list accessgroup with children
	 * @param int: id of accessgroup
	 *
	 */
	function $$$showAccessgroups__listAccessgroups ($Template, $id) {
		global $TSunic;
		$Group = $TSunic->get('$$$Accessgroup', $id);

		echo '<ul class="$system$childlist">';
		echo '    <li><a href="'.$Template->setUrl('$$$showAccessgroup',
			array('$$$id' => $id),
			true ,
			false
			).'">'.$Group->getInfo('name').'</a></li>';
		foreach ($Group->getChildren() as $index => $Child) {
			echo '    <li>'.$$$showAccessgroups__listAccessgroups($Template, $Child->getInfo('id')).'</li>';
		}
		echo '</ul>';
	}

	// list all accessgroups
	$$$showAccessgroups__listAccessgroups($this, 1);
	?>
</div>
