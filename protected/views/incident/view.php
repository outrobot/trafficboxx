<?php
$this->breadcrumbs=array(
	'Incidents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Incident','url'=>array('index')),
	array('label'=>'Create Incident','url'=>array('create')),
	array('label'=>'Update Incident','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Incident','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Incident','url'=>array('admin')),
);
?>

<h1>View Incident #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'location',
		'criticality',
		'type',
		'direction',
		'type_description',
		'gps_lat',
		'gps_lng',
		'start_time',
		'end_time',
		'create_time',
		'update_time',
	),
)); ?>
