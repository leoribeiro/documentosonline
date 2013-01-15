<?php
/* @var $this DProcessoDisciplinarController */
/* @var $model DProcessoDisciplinar */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDProcessoDisciplinar'); ?>
		<?php echo $form->textField($model,'CDProcessoDisciplinar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DataOcorrencia'); ?>
		<?php echo $form->textField($model,'DataOcorrencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DataCriacao'); ?>
		<?php echo $form->textField($model,'DataCriacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DescricaoOcorrencia'); ?>
		<?php echo $form->textArea($model,'DescricaoOcorrencia',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ParecerComissao'); ?>
		<?php echo $form->textArea($model,'ParecerComissao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SansaoAplicavel'); ?>
		<?php echo $form->textField($model,'SansaoAplicavel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ParecerDiretor'); ?>
		<?php echo $form->textField($model,'ParecerDiretor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DescricaoParecer'); ?>
		<?php echo $form->textArea($model,'DescricaoParecer',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->