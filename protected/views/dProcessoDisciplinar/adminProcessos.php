<?php
/* @var $this DProcessoDisciplinarController */
/* @var $model DProcessoDisciplinar */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('dprocesso-disciplinar-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="titlePages">
		Processos Disciplinares
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
	$dropSituacao = array();
	$dropSituacao['Enviado'] = 'Enviado';
	$dropSituacao['Analisado pela comissão disciplinar'] = 'Analisado pela comissão disciplinar';
	$dropSituacao['Concluído'] = 'Concluído';


	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'dprocesso-disciplinar-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search('todos'),
	'enableSorting'=>false,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'filter'=>$model,
	'columns'=>array(
		'CDProcessoDisciplinar',
		array(
			'name'=>'DataOcorrencia',
			'value'=>'date("d/m/Y",strtotime($data->DataOcorrencia))',
			'type'=>'text',
			'header'=>'Data da criação',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'DataOcorrencia',
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
		'Aluno',
		// array(
		// 	'name'=>'alunoNMAluno',
		// 	'value'=>'$data->relAluno->NMAluno',
		// 	'type'=>'text',
		// 	'header'=>'Aluno',
		// ),
		array(
			'name'=>'servidorNMServidor',
			'value'=>'$data->relServidorProcesso->NMServidor',
			'type'=>'text',
			'header'=>'Relator',
		),
		array(
			'name'=>'Situacao',
			'value'=>'$data->situacaoProcesso($data->CDProcessoDisciplinar)',
			'type'=>'text',
			'header'=>'Situação',
			'filter'=>$dropSituacao,
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {situacao} {update} {geraPDF} {delete}',
			//'htmlOptions' => array('width'=>75),
			'buttons' => array(
			'situacao' => array(
			            'label'=>'Analisar processo',
						'url'=> 'Yii::app()->createUrl("dProcessoDisciplinar/updateProcesso", array("id" => $data->CDProcessoDisciplinar))',
						'imageUrl'=>Yii::app()->request->baseUrl
						.'/images/b_newtbl.png',
						'visible'=>'$data->visSituacao($data->CDProcessoDisciplinar)',
			),
			'delete' => array(
			            'visible'=>'$data->visProcesso($data->CDProcessoDisciplinar)',
			),
			'update' => array(
						'visible'=>'$data->visProcesso($data->CDProcessoDisciplinar)',
			),
			'geraPDF' => array(
				            'label'=>'Gerar PDF',
							'url'=> 'Yii::app()->createUrl("DocumentosPDF/geraProcessoDisciplinar", array("id" => $data->CDProcessoDisciplinar))',
							'imageUrl'=>Yii::app()->request->baseUrl
							.'/images/pdf.png',
				            'visible'=>'$data->visPDF($data->CDProcessoDisciplinar)',
			),
			),
		),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
}
");


?>
