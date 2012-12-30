<!-- | Template: show list of selections -->
<?php
// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$selections = $this->getVar('selections');
?>
<div id="$$$div__showListSelections">
    <?php if (is_array($selections) AND count($selections) > 0) { ?>
    <table>
	<tr style="width:100%;">
	    <th><?php $this->set('{SHOWLISTSELECTIONS__NAME}'); ?></th>
	    <th><?php $this->set('{SHOWLISTSELECTIONS__DESCRIPTION}'); ?></th>
	    <th><?php $this->set('{SHOWLISTSELECTIONS__ACTIONS}'); ?></th>
	</tr>
	<?php foreach ($selections as $index => $Value) { ?>
	<tr style="margin:1px; padding:5px;">
	    <td>
		<?php $this->set($Value->getInfo('name')); ?>
	    </td>
	    <td>
		<?php $this->set($Value->getInfo('description')); ?>
	    </td>
	    <td>
		<a href="<?php $this->setUrl('$$$showEditSelection', array('$$$id' => $Value->getInfo('id')));?>">
		    <img class="$system$editImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWLISTSELECTIONS__EDIT}'); ?>" />
		</a>
		<a href="<?php $this->setUrl('$$$showDeleteSelection', array('$$$id' => $Value->getInfo('id')));?>"  id="$$$showListSelections__delete_<?php $this->set($Value->getInfo('id')); ?>">
		    <img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWLISTSELECTIONS__DELETE}'); ?>" />
		</a>
	    </td>
	</tr>
	<?php } ?>
    </table>
    <?php } else { ?>
    <p>
	<?php $this->set('{SHOWLISTSELECTIONS__NOSELECTIONS}'); ?>
    </p>
    <?php } ?>
</div>

<script type="text/javascript">

    // get selections
    var $$$showListSelections_all = new Array();
    <?php foreach ($selections as $index => $Value) {
    if ($Value->getInfo('id') == 0) continue;
    echo '$$$showListSelections_all["id_'.$Value->getInfo('id').'"] = new Array("$$$showListSelections__delete_'.$Value->getInfo('id').'",
	    "'.$Value->getInfo('name').'",
	    "'.$this->setUrl('$$$deleteSelection', array('$$$id' => $Value->getInfo('id')), false, false).'");';
    } ?>

    // add events
    for (arr_index in $$$showListSelections_all) {
	function $$$showListSelections__addEvents (input) {

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
	$$$showListSelections__addEvents($$$showListSelections_all[arr_index]);
    }
</script>
