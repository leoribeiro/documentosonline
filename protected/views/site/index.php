<div id="titlePages">
	Documentos Oficiais
</div>

<?php 

	$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ddocumento-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'enableSorting'=>false,
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'nomeDocumento',
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
			'name'=>'servidorNMServidor',
			'value'=>'$data->relServidor->NMServidor',
			'type'=>'text',
			'header'=>'Responsável',
		),
		array(
			'name'=>'DataCriacao',
			'value'=>'date("d/m/Y",strtotime($data->DataCriacao))',
			'type'=>'text',
			'header'=>'Data da criação',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'DataCriacao',
                    'language'=>'pt-BR',
					'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
		            'htmlOptions' => array(
                      'id' => 'datepicker_for_due_date',
                      'size' => '10',
                    ),
					'defaultOptions' => array(  // (#3)
	                    'showOn' => 'focus', 
	                    'dateFormat' => 'dd/mm/yy',
	                    'showOtherMonths' => true,
	                    'selectOtherMonths' => true,
	                    'changeMonth' => true,
	                    'changeYear' => true,
	                    'showButtonPanel' => true,
	                )
	           ), true),
		),
		array(
			'name'=>'DataDocumento',
			'value'=>'date("d/m/Y",strtotime($data->DataDocumento))',
			'type'=>'text',
			'header'=>'Data do documento',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'DataDocumento',
                    'language'=>'pt-BR',
					'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
		            'htmlOptions' => array(
                      'id' => 'datepicker_for_due_date2',
                      'size' => '10',
                    ),
					'defaultOptions' => array(  // (#3)
	                    'showOn' => 'focus', 
	                    'dateFormat' => 'dd/mm/yy',
	                    'showOtherMonths' => true,
	                    'selectOtherMonths' => true,
	                    'changeMonth' => true,
	                    'changeYear' => true,
	                    'showButtonPanel' => true,
	                )
	           ), true),
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
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
    $('#datepicker_for_due_date2').datepicker();
}
");
?>