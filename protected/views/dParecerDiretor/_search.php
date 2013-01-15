<?php
/* @var $this DParecerDiretorController */
/* @var $model DParecerDiretor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDParecer'); ?>
		<?php echo $form->textField($model,'CDParecer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMParecer'); ?>
		<?php echo $form->textField($model,'NMParecer',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->