<?php
/* @var $this DSansaoAplicavelController */
/* @var $model DSansaoAplicavel */

$this->breadcrumbs=array(
	'Dsansao Aplicavels'=>array('index'),
	$model->CDSansao=>array('view','id'=>$model->CDSansao),
	'Update',
);

$this->menu=array(
	array('label'=>'List DSansaoAplicavel', 'url'=>array('index')),
	array('label'=>'Create DSansaoAplicavel', 'url'=>array('create')),
	array('label'=>'View DSansaoAplicavel', 'url'=>array('view', 'id'=>$model->CDSansao)),
	array('label'=>'Manage DSansaoAplicavel', 'url'=>array('admin')),
);
?>

<h1>Update DSansaoAplicavel <?php echo $model->CDSansao; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>