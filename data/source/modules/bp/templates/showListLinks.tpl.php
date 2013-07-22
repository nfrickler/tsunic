<!-- | TEMPLATE show list of linked objects -->
<?php
// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$links = $this->getVar('links');
$object = $this->getVar('object');
?>
<div id="$$$div__showListLinks">
    <?php if (is_array($links) AND count($links) > 0) { ?>
    <table>
	<tr style="width:100%;">
	    <th><?php $this->set('{SHOWLISTLINKS__NAME}'); ?></th>
	    <th><?php $this->set('{SHOWLISTLINKS__DESCRIPTION}'); ?></th>
	    <th><?php $this->set('{SHOWLISTLINKS__ACTIONS}'); ?></th>
	</tr>
	<?php foreach ($links as $index => $Value) { ?>
	<?php $LinkedObject = $Value->getObject($object); ?>
	<tr style="margin:1px; padding:5px;">
	    <td>
		<?php if ($LinkedObject) $this->set($LinkedObject->getName()); ?>
	    </td>
	    <td>
		<?php $this->set('---'); ?>
	    </td>
	    <td>
		<a href="<?php $this->setUrl('$$$deleteLink', array('$$$id' => $Value->getInfo('id')));?>"  id="$$$showListLinks__delete_<?php $this->set($Value->getInfo('id')); ?>">
		    <img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWLISTLINKS__DELETE}'); ?>" />
		</a>
	    </td>
	</tr>
	<?php } ?>
    </table>
    <?php } ?>
</div>

<script type="text/javascript">

    // get selections
    var $$$showListLinks_all = new Array();
    <?php foreach ($selections as $index => $Value) {
    if ($Value->getInfo('id') == 0) continue;
    echo '$$$showListLinks_all["id_'.$Value->getInfo('id').'"] = new Array("$$$showListLinks__delete_'.$Value->getInfo('id').'",
	    "'.$Value->getInfo('name').'",
	    "'.$this->setUrl('$$$deleteSelection', array('$$$id' => $Value->getInfo('id')), false, false).'");';
    } ?>

    // add events
    for (arr_index in $$$showListLinks_all) {
	function $$$showListLinks__addEvents (input) {

	    // get Values
	    var object = document.getElementById(input[0]);
	    var name = input[1];
	    var button1_href = input[2];

	    // add onclick-event
	    object.onclick = function(){

		// create optionbox
		var allobjects = $system$showOptionbox('<?php $this->set('{SHOWDELETESELECTION__POPUP_DELETE_HEADER_JS}'); ?>',
		'<?php $this->set('{SHOWDELETESELECTION__POPUP_DELETE_CONTENT}'); ?>',
		'<?php $this->set('{SHOWDELETESELECTION__POPUP_DELETE_YES}'); ?>',
		'<?php $this->set('{SHOWDELETESELECTION__POPUP_DELETE_NO}'); ?>');

		// add yes-button-event
		allobjects['button1'].onclick = function(){

		    // redirect
		    location.href= button1_href;

		};

		// reset onclick
		return false;
	    };

	}
	$$$showListLinks__addEvents($$$showListLinks_all[arr_index]);
    }
</script>
