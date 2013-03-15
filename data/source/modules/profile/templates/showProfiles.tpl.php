<!-- | TEMPLATE show list of all your profiles -->
<div id="$$$div__showIndex">
    <h1><?php $this->set('{SHOWPROFILES__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateProfile'); ?>">
	    <?php $this->set('{SHOWPROFILES__TOCREATEPROFILE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWPROFILES__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$showListProfiles', array(
	'profiles' => $this->getVar('profiles'),
    )); ?>
</div>
