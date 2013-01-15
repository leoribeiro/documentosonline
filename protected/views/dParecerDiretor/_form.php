<?php
/* @var $this DParecerDiretorController */
/* @var $model DParecerDiretor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dparecer-diretor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMParecer'); ?>
		<?php echo $form->textField($model,'NMParecer',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NMParecer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->