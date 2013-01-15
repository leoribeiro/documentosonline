<?php
/* @var $this DParecerDiretorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dparecer Diretors',
);

$this->menu=array(
	array('label'=>'Create DParecerDiretor', 'url'=>array('create')),
	array('label'=>'Manage DParecerDiretor', 'url'=>array('admin')),
);
?>

<h1>Dparecer Diretors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
