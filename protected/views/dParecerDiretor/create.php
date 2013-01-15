<?php
/* @var $this DParecerDiretorController */
/* @var $model DParecerDiretor */

$this->breadcrumbs=array(
	'Dparecer Diretors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DParecerDiretor', 'url'=>array('index')),
	array('label'=>'Manage DParecerDiretor', 'url'=>array('admin')),
);
?>

<h1>Create DParecerDiretor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>