<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permanent_id')); ?>:</b>
	<?php echo CHtml::encode($data->permanent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drivetime')); ?>:</b>
	<?php echo CHtml::encode($data->drivetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delaytime')); ?>:</b>
	<?php echo CHtml::encode($data->delaytime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
	<?php echo CHtml::encode($data->length); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('jamfactor')); ?>:</b>
	<?php echo CHtml::encode($data->jamfactor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jamfactor_trend')); ?>:</b>
	<?php echo CHtml::encode($data->jamfactor_trend); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('average_speed')); ?>:</b>
	<?php echo CHtml::encode($data->average_speed); ?>
	<br />

	*/ ?>

</div>