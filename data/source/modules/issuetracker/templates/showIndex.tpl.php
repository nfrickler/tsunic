<!-- | TEMPLATE show index -->
<div id="$$$div__showIndex">
    <h1><?php $this->set('{SHOWINDEX__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateIssue'); ?>">
	    <?php $this->set('{SHOWINDEX__TOCREATEISSUE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWINDEX__INFOTEXT}'); ?>
    </p>

    <form action="<?php $this->setUrl('$$$showIndex'); ?>" method="post">
	<select id="$$$queue" name="$$$queue">
	    <option value="0"><?php $this->set('{CLASS__QUEUE__NAMEALL}'); ?></option>
	    <?php foreach ($this->getVar('queues') as $index => $Value) { ?>
	    <option value="<?php echo $Value->getInfo('id'); ?>">
		<?php $this->set($Value->getName()); ?></option>
	    <?php } ?>
	</select>
	<input type="submit" value="<?php $this->set('{SHOWINDEX__SUBMIT}'); ?>" />
    </form>

    <h2><?php $this->set('{SHOWINDEX__H1__ISSUESOFQUEUE}', array(
	'name' => $this->getVar('Queue')->getName())
    ); ?></h2>
    <?php $this->display('$$$showListIssues', array(
	'issues' => $this->getVar('issues'),
    )); ?>
</div>
