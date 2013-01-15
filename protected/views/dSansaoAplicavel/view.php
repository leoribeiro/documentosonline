<?php
/* @var $this DSansaoAplicavelController */
/* @var $model DSansaoAplicavel */

$this->breadcrumbs=array(
	'Dsansao Aplicavels'=>array('index'),
	$model->CDSansao,
);

$this->menu=array(
	array('label'=>'List DSansaoAplicavel', 'url'=>array('index')),
	array('label'=>'Create DSansaoAplicavel', 'url'=>array('create')),
	array('label'=>'Update DSansaoAplicavel', 'url'=>array('update', 'id'=>$model->CDSansao)),
	array('label'=>'Delete DSansaoAplicavel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDSansao),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DSansaoAplicavel', 'url'=>array('admin')),
);
?>

<h1>View DSansaoAplicavel #<?php echo $model->CDSansao; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDSansao',
		'NMSansao',
	),
)); ?>
