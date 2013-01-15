<?php
/* @var $this DProcessoDisciplinarController */
/* @var $model DProcessoDisciplinar */

$this->breadcrumbs=array(
	'Dprocesso Disciplinars'=>array('index'),
	$model->CDProcessoDisciplinar=>array('view','id'=>$model->CDProcessoDisciplinar),
	'Update',
);

$this->menu=array(
	array('label'=>'List DProcessoDisciplinar', 'url'=>array('index')),
	array('label'=>'Create DProcessoDisciplinar', 'url'=>array('create')),
	array('label'=>'View DProcessoDisciplinar', 'url'=>array('view', 'id'=>$model->CDProcessoDisciplinar)),
	array('label'=>'Manage DProcessoDisciplinar', 'url'=>array('admin')),
);
?>

<h1>Update DProcessoDisciplinar <?php echo $model->CDProcessoDisciplinar; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>