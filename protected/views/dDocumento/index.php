<?php
/* @var $this DDocumentoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ddocumentos',
);

$this->menu=array(
	array('label'=>'Create DDocumento', 'url'=>array('create')),
	array('label'=>'Manage DDocumento', 'url'=>array('admin')),
);
?>

<h1>Ddocumentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
