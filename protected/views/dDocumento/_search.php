<?php
/* @var $this DDocumentoController */
/* @var $model DDocumento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDDocumento'); ?>
		<?php echo $form->textField($model,'CDDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Assunto'); ?>
		<?php echo $form->textArea($model,'Assunto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Corpo'); ?>
		<?php echo $form->textArea($model,'Corpo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DataCriacao'); ?>
		<?php echo $form->textField($model,'DataCriacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DataDocumento'); ?>
		<?php echo $form->textField($model,'DataDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ModeloDocumento_CDModeloDocumento'); ?>
		<?php echo $form->textField($model,'ModeloDocumento_CDModeloDocumento'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->