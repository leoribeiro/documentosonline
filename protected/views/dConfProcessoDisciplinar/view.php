<?php
/* @var $this DConfProcessoDisciplinarController */
/* @var $model DConfProcessoDisciplinar */

$this->breadcrumbs=array(
	'Dconf Processo Disciplinars'=>array('index'),
	$model->CDConf,
);

$this->menu=array(
	array('label'=>'List DConfProcessoDisciplinar', 'url'=>array('index')),
	array('label'=>'Create DConfProcessoDisciplinar', 'url'=>array('create')),
	array('label'=>'Update DConfProcessoDisciplinar', 'url'=>array('update', 'id'=>$model->CDConf)),
	array('label'=>'Delete DConfProcessoDisciplinar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDConf),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DConfProcessoDisciplinar', 'url'=>array('admin')),
);
?>

<h1>View DConfProcessoDisciplinar #<?php echo $model->CDConf; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDConf',
		'Servidor_Diretor',
		'Servidor_Comissao',
	),
)); ?>
