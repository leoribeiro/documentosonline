<?php
/* @var $this DSansaoAplicavelController */
/* @var $model DSansaoAplicavel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDSansao'); ?>
		<?php echo $form->textField($model,'CDSansao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMSansao'); ?>
		<?php echo $form->textField($model,'NMSansao',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->