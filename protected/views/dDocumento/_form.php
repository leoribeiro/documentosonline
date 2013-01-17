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
	'enableAjaxValidation'=>false,

)); ?>


	<?php echo $form->errorSummary($model); ?>

	<fieldset>
 
    <legend>Modelo de documento</legend>

    <div class="row">
    	<?php //echo $form->labelEx($model,'ModeloDocumento_CDModeloDocumento'); ?>
    	<?php
    		$criteria = new CDbCriteria();
    		if(empty($model->Servidor_CDServidor)){
    			$criteria->compare('Responsavel',Yii::app()->user->CDServidor);
    		}
    		else{
    			$criteria->compare('Responsavel',$model->Servidor_CDServidor);
    			$Data = $model->DataDocumento;
				$ar = explode('-', $Data);
				$model->DataDocumento = $ar[2].'/'.$ar[1].'/'.$ar[0];
    		}
    		
    		$modelos = DResponsavelDocumento::model()->findAll($criteria);

    		$idsModelo = array();

    		foreach($modelos as $modelo){
    			$idsModelo[] = $modelo->ModeloDocumento;
    		}

    		$criteria = new CDbCriteria();
			$criteria->addInCondition('CDModeloDocumento',$idsModelo);

			$modelosDocumentos = DModeloDocumento::model()->findAll($criteria);

			$lista = CHtml::listData($modelosDocumentos, 'CDModeloDocumento', 'NMSiglaDocumento');

    	?>
		<?php echo CHtml::activeDropDownList($model,'ModeloDocumento_CDModeloDocumento',
		$lista,array('empty'=>'','style'=>'width:220px')); ?>
		<?php echo $form->error($model,'ModeloDocumento_CDModeloDocumento'); ?>
	</div>

	</fieldset>

	<fieldset>
 
    <legend>Cabeçalho</legend>

	<div class="row">
		<?php echo $form->labelEx($model,'DataDocumento'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
	    	$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, 
				'attribute'=>'DataDocumento', 
				'mode'=>'date', 
				'language' => 'pt-BR',

	    	));
		?>
		<?php echo $form->error($model,'DataDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Local'); ?>
		<?php echo $form->textField($model,'Local',array('value'=>'Timóteo')); ?>
		<?php echo $form->error($model,'Local'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Para'); ?>
		<?php echo $form->textArea($model, 'Para', array('rows'=>5,'class'=>'span10')); ?>
		<?php echo $form->error($model,'Para'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Assunto'); ?>
		<?php echo $form->textArea($model, 'Assunto', array('rows'=>5,'class'=>'span10')); ?>
		<?php echo $form->error($model,'Assunto'); ?>
	</div>

	</fieldset>
	<fieldset>
 
    <legend>Corpo</legend>
	<div class="row">
		<?php //echo $form->labelEx($model,'Corpo'); ?>
		<?php echo $form->textArea($model,'Corpo',array('rows'=>10, 'class'=>'span10')); ?>
		<?php echo $form->error($model,'Corpo'); ?>
	</div>
	</fieldset>


	<br />
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Criar documento',
		'type'=>'primary',
	)); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->