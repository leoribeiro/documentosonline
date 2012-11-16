<?php
/* @var $this DDocumentoController */
/* @var $model DDocumento */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ddocumento-form',
	'htmlOptions'=>array('class'=>'well'),
	'type'=>'form-horizontal',
	'enableAjaxValidation'=>true,
        'clientOptions' => array(
      		//'validateOnSubmit'=>true,
      		'validateOnChange'=>true,
      		'validateOnType'=>false,
    	),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<fieldset>
 
    <legend>Assinatura</legend>

    	<div class="row">
		<?php echo $form->labelEx($model,'Assinatura'); ?>
		<?php echo $form->textArea($model, 'Assinatura', array('rows'=>5,'class'=>'span10')); ?>
		<?php echo $form->error($model,'Assinatura'); ?>
	</div>

	</fieldset>



	<br />
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Salvar')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->