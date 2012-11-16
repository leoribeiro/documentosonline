<?php
/* @var $this DDocumentoController */
/* @var $model DDocumento */

$this->breadcrumbs=array(
	'Ddocumentos'=>array('index'),
	$model->CDDocumento,
);

$this->menu=array(
	array('label'=>'List DDocumento', 'url'=>array('index')),
	array('label'=>'Create DDocumento', 'url'=>array('create')),
	array('label'=>'Update DDocumento', 'url'=>array('update', 'id'=>$model->CDDocumento)),
	array('label'=>'Delete DDocumento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDDocumento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DDocumento', 'url'=>array('admin')),
);
?>

<h1>View DDocumento #<?php echo $model->CDDocumento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDDocumento',
		'Assunto',
		'Corpo',
		'DataCriacao',
		'DataDocumento',
		'ModeloDocumento_CDModeloDocumento',
	),
)); ?>
