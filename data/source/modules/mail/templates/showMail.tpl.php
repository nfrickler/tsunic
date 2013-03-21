<!-- | TEMPLATE show mail -->
<?php
// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$Mail = $this->getVar('Mail');
$attachments = $Mail->getAttachments();
?>
<div id="$$$div__showMail">
    <h1><?php $this->set('{SHOWMAIL__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showMailbox', array('$$$id' => $Mail->getInfo('fk_mailbox'))); ?>">
	    <?php $this->set('{SHOWMAIL__TOSHOWMAILBOX}'); ?></a>
    </p>

    <div class="$$$div__showMail__mail">
	<div class="$$$div__showMail_mailheader">
	    <div class="$$$div__showMail__mailheader_subject">
		<?php $this->set($Mail->getInfo('subject')); ?>
	    </div>
	    <div class="$$$div__showMail__mailheader_right">
		<a href="<?php $this->setUrl('$$$showEditMail', array('$$$id' => $Mail->getInfo('id'))); ?>" id="$$$showMail__edit">
		    <img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWMAIL__EDIT}'); ?>" /></a>
		<a href="<?php $this->setUrl('$$$showDeleteMail', array('$$$id' => $Mail->getInfo('id'))); ?>" id="$$$showMail__delete">
		    <img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWMAIL__DELETE}'); ?>" /></a>
	    </div>
	    <div style="clear:both;"></div>
	    <table class="$$$div__showMail__mailheader_table">
		<tr>
		    <th><?php $this->set('{TAG__MAIL__SENDER}'); ?></th>
		    <td><?php $this->set($Mail->getInfo('sender')); ?></td>
		</tr>
		<tr>
		    <th><?php $this->set('{TAG__MAIL__ADDRESSEE}'); ?></th>
		    <td><?php $this->set($Mail->getInfo('addressee')); ?></td>
		</tr>
		<?php if ($Mail->getInfo('date')) { ?>
		<tr>
		    <th><?php $this->set('{TAG__MAIL__DATE}'); ?></th>
		    <td><?php $this->set($Mail->getInfo('date')); ?></td>
		</tr>
		<?php } ?>
	    </table>
	</div>
	<iframe id="$$$div__showMail_mailcontent" class="$$$div__showMail_mailcontent" src="<?php $this->setUrl('$$$showMailContent', array('$$$id' => $Mail->getInfo('id'), 'tmpl' => '$$$showMailContent')); ?>">
	    <?php $this->set('{SHOWMAIL__NOIFRAMESUPPORT}'); ?>
	    <a href="<?php $this->setUrl('$$$showMailContent', array('$$$id' => $Mail->getInfo('id'), 'tmpl' => '$$$showMailContent')); ?>" target="_blank">
		<?php $this->set('{SHOWMAIL__NOIFRAMESUPPORT_OPENMAIL}'); ?></a>
	</iframe>
	<?php if (!empty($attachments)) { ?>
	<div class="$$$div__showMail__attachments">
	    <h3><?php $this->set('{SHOWMAIL__ATTACHMENTS}'); ?></h3>
	    <?php foreach ($attachments as $index => $Value) { ?>
	    | <a href="<?php $this->setImg('private', $Value->getInfo('id'), true, true); ?>"><?php $this->set($Value->getInfo('name')); ?></a>
	    <?php } ?>
	</div>
	<?php } ?>
    </div>

    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('$$$showCreateMail', array('$$$id' => $Mail->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWMAIL__ANSWERMAIL}'); ?></a>
    </p>
</div>

<script type="text/javascript">

    // add delete-event
    var deleteLink = document.getElementById('$$$showMail__delete');
    deleteLink.onclick = function() {

	// create optionbox
	var allobjects = $system$showOptionbox('<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_HEADER_JS}'); ?>',
	    '<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_CONTENT}'); ?>',
	    '<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_YES}'); ?>',
	    '<?php $this->set('{SHOWDELETEMAIL__POPUP_DELETE_NO}'); ?>');

	allobjects['button1'].onclick = function() {
	    location.href = "<?php $this->setUrl('$$$deleteMail', array('$$$id' => $Mail->getInfo('id')), false); ?>";
	};

	// reset onclick-event
	return false;
    };

    // start timeout
    function $$$showMails__calcHeight() {
	setTimeout("$$$showMails__calcHeight2();", 100);
    }

    // calculate height of iframe
    function $$$showMails__calcHeight2() {
	var myiframe = document.getElementById('$$$div__showMail_mailcontent');

	//find the height of the internal page
	var the_height = myiframe.contentWindow.document.body.scrollHeight;

	//change the height of the iframe
	myiframe.style.height = the_height + "px";
    }


    document.getElementById('$$$div__showMail_mailcontent').onload = $$$showMails__calcHeight();
</script>
