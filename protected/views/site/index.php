<div id="titlePages">
	Documentos oficiais do campus
</div>

<?php 

	$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ddocumento-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'CDDocumento',
			'value'=>'$data->numeroDocumento($data->CDDocumento)',
			'type'=>'text',
			'header'=>'Documento',
		),
		array(
			'name'=>'Assunto',
			'value'=>'$data->Assunto',
			'type'=>'text',
			'header'=>'Assunto',
			'htmlOptions'=>array('style'=>'width: 47%'),
		),
		array(
			'name'=>'Servidor_CDServidor',
			'value'=>'$data->relServidor->NMServidor',
			'type'=>'text',
			'header'=>'Responsável',
		),
		array(
			'name'=>'DataCriacao',
			'value'=>'date("d/m/Y",strtotime($data->DataCriacao))',
			'type'=>'text',
			'header'=>'Data da criação',
		),
		array(
			'name'=>'DataDocumento',
			'value'=>'date("d/m/Y",strtotime($data->DataDocumento))',
			'type'=>'text',
			'header'=>'Data do documento',
		),
		
		array(
			'class'=>'CButtonColumn',
				'template'=>'{geraPDF} {delete}',
				'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
			      array(
			           'onchange'=>"$.fn.yiiGridView.update('requerimentos-grid',{ data:{pageSize: $(this).val() }})",
					   'style'=>'width:50px; font-size: 12px; padding: 0px;margin-bottom: 0px;',
			      )),
				'buttons' => array(
				'geraPDF' => array(
				            'label'=>'Baixar documento',
							'url'=> 'Yii::app()->createUrl("DocumentosPDF/geraPDF", array("idReq" => $data->CDDocumento))',
							'imageUrl'=>Yii::app()->request->baseUrl
							.'/images/pdf.png',
				),
				'delete' => array(
				            'label'=>'Deletar documento',
							'url'=> 'Yii::app()->createUrl("DDocumento/delete", array("id" => $data->CDDocumento))',
							//'imageUrl'=>Yii::app()->request->baseUrl
							//.'/images/pdf.png',
							'visible'=>'(Yii::app()->user->name == \'admin\')',
				),
				),
		),
	),
)); ?>