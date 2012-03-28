<!-- | -->
<li id="$$$_navigation_header">
	<a href="<?php $this->setUrl('$$$showMain'); ?>">
		<?php $this->set('{_NAVIGATION_HEADER}'); ?>
	</a>
</li>
<script type="text/javascript">

	// add events
	document.getElementById('$$$_navigation_header').onclick = function(){location.href='<?php $this->setUrl('$$$showMain', false, false); ?>';};

</script>
