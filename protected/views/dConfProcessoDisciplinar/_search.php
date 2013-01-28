<?php
/* @var $this DConfProcessoDisciplinarController */
/* @var $model DConfProcessoDisciplinar */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDConf'); ?>
		<?php echo $form->textField($model,'CDConf'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Servidor_Diretor'); ?>
		<?php echo $form->textField($model,'Servidor_Diretor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Servidor_Comissao'); ?>
		<?php echo $form->textField($model,'Servidor_Comissao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->