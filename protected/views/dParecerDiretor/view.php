<?php
/* @var $this DParecerDiretorController */
/* @var $model DParecerDiretor */

$this->breadcrumbs=array(
	'Dparecer Diretors'=>array('index'),
	$model->CDParecer,
);

$this->menu=array(
	array('label'=>'List DParecerDiretor', 'url'=>array('index')),
	array('label'=>'Create DParecerDiretor', 'url'=>array('create')),
	array('label'=>'Update DParecerDiretor', 'url'=>array('update', 'id'=>$model->CDParecer)),
	array('label'=>'Delete DParecerDiretor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDParecer),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DParecerDiretor', 'url'=>array('admin')),
);
?>

<h1>View DParecerDiretor #<?php echo $model->CDParecer; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDParecer',
		'NMParecer',
	),
)); ?>
