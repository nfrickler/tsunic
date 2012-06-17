<!-- | TEMPLATE - show system-information -->
<?php

// get input
$modules = $this->getData('modules');
?>
<div class="$$$div__systeminfo">
    <h1><?php $this->set('{SYSTEMINFO__H1}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SYSTEMINFO__INFOTEXT}'); ?></p>

    <h2><?php $this->set('{SYSTEMINFO__SHOWMODULES_H1}'); ?></h2>
    <p><?php $this->set('{SYSTEMINFO__SHOWMODULES_INFOTEXT}'); ?></p>
    <table>
	<tr>
	    <th><?php $this->set('{SYSTEMINFO__SHOWMODULES_NAME}'); ?></th>
	    <th><?php $this->set('{SYSTEMINFO__SHOWMODULES_VERSION}'); ?></th>
	    <th><?php $this->set('{SYSTEMINFO__SHOWMODULES_DESCRIPTION}'); ?></th>
	    <th><?php $this->set('{SYSTEMINFO__SHOWMODULES_LINK}'); ?></th>
	</tr>
	<?php foreach ($modules as $index => $values) { ?>
	<tr>
	    <td><?php echo $values['name']; ?></td>
	    <td><?php echo $values['version_installed']; ?></td>
	    <td><?php echo $values['description']; ?></td>
	    <td>
		<?php if (!empty($values['link'])) { ?>
		<a href="<?php echo $values['link']; ?>" target="_blank">
		    <?php $this->set('{SYSTEMINFO__SHOWMODULES_TOLINK}'); ?></a>
		<?php } ?>
	    </td>
	</tr>
	<?php } ?>
    </table>
</div>
