<?php
/* @var $this DDocumentoController */
/* @var $model DDocumento */

$this->breadcrumbs=array(
	'Ddocumentos'=>array('index'),
	$model->CDDocumento=>array('view','id'=>$model->CDDocumento),
	'Update',
);

$this->menu=array(
	array('label'=>'List DDocumento', 'url'=>array('index')),
	array('label'=>'Create DDocumento', 'url'=>array('create')),
	array('label'=>'View DDocumento', 'url'=>array('view', 'id'=>$model->CDDocumento)),
	array('label'=>'Manage DDocumento', 'url'=>array('admin')),
);
?>

<h1>Update DDocumento <?php echo $model->CDDocumento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>