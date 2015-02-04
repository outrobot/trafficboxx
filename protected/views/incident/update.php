<?php
$this->breadcrumbs=array(
	'Incidents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Incident','url'=>array('index')),
	array('label'=>'Create Incident','url'=>array('create')),
	array('label'=>'View Incident','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Incident','url'=>array('admin')),
);
?>

<h1>Update Incident <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>