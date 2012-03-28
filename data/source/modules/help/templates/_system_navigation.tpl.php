<!-- | -->
<div id="$$$div___navigation">
	<ul>
		<li id="$$$_navigation__showMain"><a href="<?php $this->setUrl('$$$showMain'); ?>"><?php $this->set('{_SYSTEM_NAVIGATION__SHOWMAIN}'); ?></a></li>
	</ul>
</div>

<script type="text/javascript">

	// add events
	document.getElementById('$$$_navigation__showMain').onclick = function(){location.href='<?php $this->setUrl('$$$showMain', false, false); ?>';};

</script>
