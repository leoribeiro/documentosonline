<?php
/* @var $this DSansaoAplicavelController */
/* @var $model DSansaoAplicavel */

$this->breadcrumbs=array(
	'Dsansao Aplicavels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DSansaoAplicavel', 'url'=>array('index')),
	array('label'=>'Manage DSansaoAplicavel', 'url'=>array('admin')),
);
?>

<h1>Create DSansaoAplicavel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>