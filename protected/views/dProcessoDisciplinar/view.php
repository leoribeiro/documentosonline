<?php
/* @var $this DProcessoDisciplinarController */
/* @var $model DProcessoDisciplinar */

$this->breadcrumbs=array(
	'Dprocesso Disciplinars'=>array('index'),
	$model->CDProcessoDisciplinar,
);

$this->menu=array(
	array('label'=>'List DProcessoDisciplinar', 'url'=>array('index')),
	array('label'=>'Create DProcessoDisciplinar', 'url'=>array('create')),
	array('label'=>'Update DProcessoDisciplinar', 'url'=>array('update', 'id'=>$model->CDProcessoDisciplinar)),
	array('label'=>'Delete DProcessoDisciplinar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDProcessoDisciplinar),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DProcessoDisciplinar', 'url'=>array('admin')),
);
?>

<h1>View DProcessoDisciplinar #<?php echo $model->CDProcessoDisciplinar; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDProcessoDisciplinar',
		'DataOcorrencia',
		'DataCriacao',
		'DescricaoOcorrencia',
		'ParecerComissao',
		'SansaoAplicavel',
		'ParecerDiretor',
		'DescricaoParecer',
	),
)); ?>
