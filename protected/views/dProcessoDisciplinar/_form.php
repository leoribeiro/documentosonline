<?php
/* @var $this DProcessoDisciplinarController */
/* @var $model DProcessoDisciplinar */
/* @var $form CActiveForm */
?>

<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $form->labelEx($model,'DataOcorrencia'); ?>
		<?php echo $form->textField($model,'DataOcorrencia'); ?>
		<?php echo $form->error($model,'DataOcorrencia'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DataOcorrencia'); ?>
		<?php echo $form->textField($model,'DataOcorrencia'); ?>
		<?php echo $form->error($model,'DataOcorrencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DataCriacao'); ?>
		<?php echo $form->textField($model,'DataCriacao'); ?>
		<?php echo $form->error($model,'DataCriacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescricaoOcorrencia'); ?>
		<?php echo $form->textArea($model,'DescricaoOcorrencia',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DescricaoOcorrencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ParecerComissao'); ?>
		<?php echo $form->textArea($model,'ParecerComissao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ParecerComissao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SansaoAplicavel'); ?>
		<?php echo $form->textField($model,'SansaoAplicavel'); ?>
		<?php echo $form->error($model,'SansaoAplicavel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ParecerDiretor'); ?>
		<?php echo $form->textField($model,'ParecerDiretor'); ?>
		<?php echo $form->error($model,'ParecerDiretor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescricaoParecer'); ?>
		<?php echo $form->textArea($model,'DescricaoParecer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DescricaoParecer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->