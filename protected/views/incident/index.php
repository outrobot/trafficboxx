<?php
$this->breadcrumbs=array(
	'Incidents',
);

$this->menu=array(
	array('label'=>'Create Incident','url'=>array('create')),
	array('label'=>'Manage Incident','url'=>array('admin')),
);
?>

<h1>Incidents</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'incident-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'description',
		'location',
		'criticality',
		array(
                    'name'=>'type',
                    'value'=>'$data->getTypeText()',
                    'filter'=>$model->getTypeOptions()
                ),
                'direction',
//                array(
//                    'name'=>'create_time',
//                    'value'=>'Yii::app()->format->timeago($data->create_time)'
//                ),
//                array(
//                    'name'=>'update_time',
//                    'value'=>'Yii::app()->format->timeago($data->update_time)',
//                    'visible'=>'$data->create_time != $data->update_time'
//                ),
                'start_time'
		/*
		'type_description',
		'gps_lat',
		'gps_lng',
		'start_time',
		'end_time',
		'create_time',
		'update_time',
		*/
	),
)); ?>
