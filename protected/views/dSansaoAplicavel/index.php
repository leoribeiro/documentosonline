<?php
/* @var $this DSansaoAplicavelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dsansao Aplicavels',
);

$this->menu=array(
	array('label'=>'Create DSansaoAplicavel', 'url'=>array('create')),
	array('label'=>'Manage DSansaoAplicavel', 'url'=>array('admin')),
);
?>

<h1>Dsansao Aplicavels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
