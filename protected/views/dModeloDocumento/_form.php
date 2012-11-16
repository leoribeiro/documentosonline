<?php
/* @var $this DModeloDocumentoController */
/* @var $model DModeloDocumento */
/* @var $form CActiveForm */
?>

<?php $this->widget('ext.EChosen.EChosen'); ?>

<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>


	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'NMModeloDocumento'); ?>
		<?php echo $form->textField($model,'NMModeloDocumento',array('size'=>60,'maxlength'=>300,'class'=>'span3')); ?>
		<?php echo $form->error($model,'NMModeloDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NMSiglaDocumento'); ?>
		<?php echo $form->textField($model,'NMSiglaDocumento',array('size'=>45,'maxlength'=>45,'class'=>'span3')); ?>
		<?php echo $form->error($model,'NMSiglaDocumento'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Servidores autorizados a criar o documento','Servidores'); 
		$modelMR = Servidor::model()->
	    findAll(array('order'=>'NMServidor'));
	    $listaServ = CHtml::listData($modelMR,
		'CDServidor','NMServidor');

	    $selecionados = array();
		if(!empty($model->relServidor)){
			foreach ($model->relServidor as $servidor) {
				$selecionados[$servidor->CDServidor] = array('selected'=>'selected');	
			}
			
		}
		
		echo CHtml::activeDropDownList($model,'relServidor',$listaServ,
		array('multiple'=>'multiple',
		'data-placeholder'=>'Selecione os responsáveis',
	  	'style'=>'width:400px',
	  	'class'=>'chzn-select',
	  	'options'=>$selecionados));

		?>
	</div>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Voltar',
    //'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'url'=>$this->createUrl('/dModeloDocumento/admin'),
    //'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Salvar')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->