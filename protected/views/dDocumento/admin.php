<div id="titlePages">
		Meus documentos
</div>

<?php 

		$this->widget('bootstrap.widgets.TbAlert', array(
    	'block'=>true, // display a larger alert block?
    	'fade'=>true, // use transitions?
    	'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    	'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    	),
		)); 

?>


<?php 

	$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ddocumento-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search('resp'),
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
			'htmlOptions'=>array('style'=>'width: 55%'),
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
				'template'=>'{geraPDF}',
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
				),
		),
	),
)); ?>
