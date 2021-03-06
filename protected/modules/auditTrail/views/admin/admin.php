<?php
$this->breadcrumbs=array(
	'Audit Trails'=>array('/auditTrail'),
	'Manage',
);
/*
$this->menu=array(
	array('label'=>'List AuditTrail', 'url'=>array('index')),
	array('label'=>'Create AuditTrail', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('audit-trail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Logs de alteração no banco de dados</h1>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'audit-trail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'old_value',
		'new_value',
		'action',
		'model',
		'field',
		'stamp',
		'user_id',
		'model_id',
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>