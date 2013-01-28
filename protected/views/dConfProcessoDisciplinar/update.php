<?php
/* @var $this DConfProcessoDisciplinarController */
/* @var $model DConfProcessoDisciplinar */

$this->breadcrumbs=array(
	'Dconf Processo Disciplinars'=>array('index'),
	$model->CDConf=>array('view','id'=>$model->CDConf),
	'Update',
);

$this->menu=array(
	array('label'=>'List DConfProcessoDisciplinar', 'url'=>array('index')),
	array('label'=>'Create DConfProcessoDisciplinar', 'url'=>array('create')),
	array('label'=>'View DConfProcessoDisciplinar', 'url'=>array('view', 'id'=>$model->CDConf)),
	array('label'=>'Manage DConfProcessoDisciplinar', 'url'=>array('admin')),
);
?>

<h1>Update DConfProcessoDisciplinar <?php echo $model->CDConf; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>