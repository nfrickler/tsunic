<!-- | template to show list of tools -->
<?php
// deny direct access
defined('TS_INIT') OR die('Access denied!');
?>
<h1><?php $this->set('SHOWTOOLS__H1'); ?></h1>
<p>
    <?php $this->set('SHOWTOOLS__INFOTEXT'); ?>
</p>
<dl>
    <dt><a href="?event=showInitDatabase"><?php $this->set('SHOWTOOLS__DT_INITDATABASE'); ?></a></dt>
    <dd><?php $this->set('SHOWTOOLS__DD_INITDATABASE'); ?></dd>
    <dt><a href="?event=showResetAll"><?php $this->set('SHOWTOOLS__DT_RESETALL'); ?></a></dt>
    <dd><?php $this->set('SHOWTOOLS__DD_RESETALL'); ?></dd>
</dl>

