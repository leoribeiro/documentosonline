<?php
/* @var $this DConfProcessoDisciplinarController */
/* @var $model DConfProcessoDisciplinar */
/* @var $form CActiveForm */
?>
<?php $this->widget('ext.EChosen.EChosen'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dconf-processo-disciplinar-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Servidor_Diretor'); ?>
		<?php
			$modelMR = Servidor::model()->
	        findAll(array('order'=>'NMServidor'));
	        $listaServ = CHtml::listData($modelMR,
		    'CDServidor','NMServidor');

		    echo CHtml::activeDropDownList($model,'Servidor_Diretor',$listaServ,
			array(
			'data-placeholder'=>'Selecione o responsável',
	  		'style'=>'width:400px',
	  		'class'=>'chzn-select'));
		?>
		<?php echo $form->error($model,'Servidor_Diretor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Servidor_Comissao'); ?>
		<?php
			$modelMR = Servidor::model()->
	        findAll(array('order'=>'NMServidor'));
	        $listaServ = CHtml::listData($modelMR,
		    'CDServidor','NMServidor');

		    echo CHtml::activeDropDownList($model,'Servidor_Comissao',$listaServ,
			array(
			'data-placeholder'=>'Selecione o responsável',
	  		'style'=>'width:400px',
	  		'class'=>'chzn-select'));
		?>
		<?php echo $form->error($model,'Servidor_Comissao'); ?>
	</div>


	<div class="row">
		<?php echo CHtml::label('Servidores autorizados a criar processo disciplinar','Servidores'); 
		$modelMR = Servidor::model()->
	    findAll(array('order'=>'NMServidor'));
	    $listaServ = CHtml::listData($modelMR,
		'CDServidor','NMServidor');

	    $selecionados = array();
	    $modelRPD = DResponsavelProcDisciplinar::model()->findAll();
		if(!empty($modelRPD)){
			foreach ($modelRPD as $servidor) {
				$selecionados[$servidor->CDServidor] = array('selected'=>'selected');	
			}
			
		}
		
		echo CHtml::DropDownList('Servidores[]','',$listaServ,
		array('multiple'=>'multiple',
		'data-placeholder'=>'Selecione os servidores',
	  	'style'=>'width:400px',
	  	'class'=>'chzn-select',
	  	'options'=>$selecionados));

		?>
	</div>

	<br />
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Salvar')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->