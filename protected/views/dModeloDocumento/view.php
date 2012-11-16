<div id="titlePages">
		Detalhe do modelo de documento
</div>

<?php 
$servidores = array();
foreach($model->relServidor as $serv){
				$servidores[] = $serv->NMServidor;
}

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDModeloDocumento',
		'NMModeloDocumento',
		'NMSiglaDocumento',
		array(
			'label'=>'Servidores autorizados',
			'value'=>implode('<br /> ',$servidores),
			'filter'=>false,
			'visible'=>(!empty($servidores)),
			'type'=>'html',
		),
	),
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Voltar',
    //'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'url'=>'admin',
    //'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>
