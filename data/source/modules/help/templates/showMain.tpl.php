<!-- | TEMPLATE main page -->
<div class="$$$div__showMain">
    <h1><?php $this->set('{SHOWMAIN__H}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWMAIN__INFOTEXT}'); ?></p>

    <h2><?php $this->set('{SHOWMAIN__H_MODULES}'); ?></h2>
    <p class="ts_infotext">
	<?php $this->set('{SHOWMAIN__MODULES_INFOTEXT}'); ?>
    </p>
    <ul>
    <?php foreach ($this->getVar('modules') as $index => $values) { ?>
	<li style="margin-top:4px;"><a href="<?php $this->setUrl('$$$showHelp',
	    array('$$$page' => 'mod'.$values['id'].'__index')
	); ?>">
	    <?php $this->set($values['name']); ?></a></li>
    <?php } ?>
    </ul>

    <h2><?php $this->set('{SHOWMAIN__H_LINKS}'); ?></h2>
    <dl>
	<dt><a href="http://tsunic.de" target="_blank">
	    <?php $this->set('{SHOWMAIN__LINKS_TSUNIC}'); ?></a>
	</dt>
	<dd><?php $this->set('{SHOWMAIN__LINKS_TSUNIC_INFO}'); ?></dd>

	<dt style="margin-top:20px;">
	    <a href="http://dokumentation.tsunic.de" target="_blank">
		<?php $this->set('{SHOWMAIN__LINKS_DOCUMENTATION}'); ?></a>
	</dt>
	<dd><?php $this->set('{SHOWMAIN__LINKS_DOCUMENTATION_INFO}'); ?></dd>
    </dl>
</div>
