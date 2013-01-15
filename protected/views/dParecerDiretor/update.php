<?php
/* @var $this DParecerDiretorController */
/* @var $model DParecerDiretor */

$this->breadcrumbs=array(
	'Dparecer Diretors'=>array('index'),
	$model->CDParecer=>array('view','id'=>$model->CDParecer),
	'Update',
);

$this->menu=array(
	array('label'=>'List DParecerDiretor', 'url'=>array('index')),
	array('label'=>'Create DParecerDiretor', 'url'=>array('create')),
	array('label'=>'View DParecerDiretor', 'url'=>array('view', 'id'=>$model->CDParecer)),
	array('label'=>'Manage DParecerDiretor', 'url'=>array('admin')),
);
?>

<h1>Update DParecerDiretor <?php echo $model->CDParecer; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>