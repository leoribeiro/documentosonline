<?php
/* @var $this DProcessoDisciplinarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dprocesso Disciplinars',
);

$this->menu=array(
	array('label'=>'Create DProcessoDisciplinar', 'url'=>array('create')),
	array('label'=>'Manage DProcessoDisciplinar', 'url'=>array('admin')),
);
?>

<h1>Dprocesso Disciplinars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
