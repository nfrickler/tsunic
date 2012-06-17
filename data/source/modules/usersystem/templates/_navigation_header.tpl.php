<!-- | TEMPLATE show header navigation -->
<li id="$$$_navigation_header__showLogin">
    <a href="<?php $this->setUrl('$$$showLogin'); ?>">
	<?php $this->set('{_HEADER_NAVIGATION__SHOWLOGIN}'); ?>
    </a>
</li>
<li id="$$$_navigation_header__showRegistration">
    <a href="<?php $this->setUrl('$$$showRegistration'); ?>">
	<?php $this->set('{_HEADER_NAVIGATION__SHOWREGISTRATION}'); ?>
    </a>
</li>

<script type="text/javascript">

    // add events
    document.getElementById('$$$_navigation_header__showLogin').onclick = function(){location.href='<?php $this->setUrl('$$$showLogin', false, false); ?>';};
    document.getElementById('$$$_navigation_header__showRegistration').onclick = function(){location.href='<?php $this->setUrl('$$$showRegistration', false, false); ?>';};

</script>
