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
                'jamfactor',
                'average_speed',
//		'jamfactor_trend',
		/*
		'length',
		'path',
		
		'average_speed',
		*/
	),
)); ?>
