<?php
/* @var $this DSansaoAplicavelController */
/* @var $model DSansaoAplicavel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dsansao-aplicavel-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMSansao'); ?>
		<?php echo $form->textField($model,'NMSansao',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NMSansao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->