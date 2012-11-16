<?php
/* @var $this DModeloDocumentoController */
/* @var $model DModeloDocumento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDModeloDocumento'); ?>
		<?php echo $form->textField($model,'CDModeloDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMModeloDocumento'); ?>
		<?php echo $form->textField($model,'NMModeloDocumento',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NumeracaoDocumento'); ?>
		<?php echo $form->textField($model,'NumeracaoDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMSiglaDocumento'); ?>
		<?php echo $form->textField($model,'NMSiglaDocumento',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->