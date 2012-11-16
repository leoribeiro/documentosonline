<?php
/* @var $this DModeloDocumentoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dmodelo Documentos',
);

$this->menu=array(
	array('label'=>'Create DModeloDocumento', 'url'=>array('create')),
	array('label'=>'Manage DModeloDocumento', 'url'=>array('admin')),
);
?>

<h1>Dmodelo Documentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
