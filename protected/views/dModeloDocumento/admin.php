<?php
/* @var $this DModeloDocumentoController */
/* @var $model DModeloDocumento */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('dmodelo-documento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="titlePages">
		Modelos de Documentos
</div>
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Novo modelo de documento',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'url'=>'create',
    //'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'dmodelo-documento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	//'template'=>"{items}",
	'columns'=>array(
		'CDModeloDocumento',
		'NMModeloDocumento',
		'NMSiglaDocumento',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
