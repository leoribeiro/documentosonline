<?php
/* @var $this DConfProcessoDisciplinarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dconf Processo Disciplinars',
);

$this->menu=array(
	array('label'=>'Create DConfProcessoDisciplinar', 'url'=>array('create')),
	array('label'=>'Manage DConfProcessoDisciplinar', 'url'=>array('admin')),
);
?>

<h1>Dconf Processo Disciplinars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
