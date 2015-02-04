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

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
