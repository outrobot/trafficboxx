<?php
$this->breadcrumbs=array(
	'Routes',
);

$this->menu=array(
	array('label'=>'Create Route','url'=>array('create')),
	array('label'=>'Manage Route','url'=>array('admin')),
);
?>

<h1>Routes</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'route-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'name',
		'description',
		'drivetime',
		'delaytime',
                array(
                    'name'=>'update_time',
                    'value'=>'Yii::app()->format->timeago($data->update_time)'
                )
		/*
		'length',
		'jamfactor',
		'jamfactor_trend',
		'path',
		
		'average_speed',
		*/
	),
)); ?>
