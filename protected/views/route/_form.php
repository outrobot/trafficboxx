<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'route-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'permanent_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'drivetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'delaytime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'length',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'jamfactor',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'jamfactor_trend',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'path',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'average_speed',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
