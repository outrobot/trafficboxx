<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'location',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'criticality',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'direction',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'type_description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'gps_lat',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'gps_lng',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'start_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'end_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
