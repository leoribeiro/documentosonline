<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/images/jquery.limit-1.2.source.js"></script>
<?php
	
	if(isset($comissao)){
		$comissao = true;
	}
	else{
		$comissao = false;
	}
	if(isset($diretor)){
		$diretor = true;
	}
	else{
		$diretor = false;
	}
	$vis = false;
	if($comissao or $diretor){
		$vis = true;
	}
?>
<?php $this->widget('ext.EChosen.EChosen'); ?>

<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>



	
	<?php echo $form->errorSummary($model); 

	if($vis){
		echo "<fieldset><legend>Descrição da ocorrência</legend>";
	}

	?>

	<div class="row">
		
		<?php echo $form->labelEx($model,'ServidorProcesso'); ?>
		<?php 
			$criteria = new CDbCriteria();

			$criteria->compare('CDServidor',$model->ServidorProcesso);	
			
			$modelS = Servidor::model()->find($criteria);
			echo $modelS->NMServidor; ?>
		<?php echo $form->error($model,'ServidorProcesso'); ?>
		<br /><br />
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Aluno'); ?>
		<?php
		if(!$vis){
			// $modelA = Aluno::model()->
	  //       findAll(array('order'=>'NMAluno'));
	  //       $listaA = CHtml::listData($modelA,
		 //    'CDAluno','NMAluno');

		 //    echo CHtml::activeDropDownList($model,'Aluno',$listaA,
			// array(
			// 'data-placeholder'=>'Selecione o aluno',
	  // 		'style'=>'width:400px',
	  // 		'empty'=>'',
	  // 		'class'=>'chzn-select'));
			echo $form->textField($model,'Aluno',array('style'=>'width:300px'));
		}
		else{
			echo $model->Aluno;

			// $criteria = new CDbCriteria();
			// $criteria->compare('Aluno_CDAluno',$model->relAluno->CDAluno);
			// $modelAT = AlunoTecnico::model()->find($criteria);
			// $modelAG = AlunoGraduacao::model()->find($criteria);

			// if(!is_null($modelAT)){
			// 	echo "<br />".$modelAT->relTurma->NMTurma." - ";
			// 	echo $modelAT->relCurso->NMCurso;
			// }
			// else{
			// 	echo "<br />".$modelAG->relCurso->NMCurso;
			// 	echo " - ".$modelAG->Periodo." Período ";
			// }
			
		}
			
		?>
		<?php echo $form->error($model,'Aluno'); ?>
		<br /><br />
	</div>

	<div class="row">
		
		<?php echo $form->labelEx($model,'DataOcorrencia'); ?>
		<?php 
			if(!empty($model->DataOcorrencia)){
					$Data = $model->DataOcorrencia;
					$ar = explode('-', $Data);
					$model->DataOcorrencia = $ar[2].'/'.$ar[1].'/'.$ar[0];
			}
			if(!$vis){
				
				Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		    	$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, 
					'attribute'=>'DataOcorrencia', 
					'mode'=>'date', 
					'language' => 'pt-BR',

		    	));
			}
			else{
				echo $model->DataOcorrencia;
			}
			
		?>
		<?php echo $form->error($model,'DataOcorrencia'); ?>
		<br /><br />
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescricaoOcorrencia'); ?>

		<?php
			if(!$vis){
				echo $form->textArea($model, 'DescricaoOcorrencia', array('rows'=>5,'class'=>'span10'));
				echo "<br />Ainda restam <span id=\"left3\"></span> caracteres a serem digitados.";
				?>
				<script type="text/javascript" >
				$('#DProcessoDisciplinar_DescricaoOcorrencia').limit('500','#left3');
				</script>
				<?
			} 
			else{
				echo $model->DescricaoOcorrencia;
			}
			?>
		<?php echo $form->error($model,'DescricaoOcorrencia'); ?>
	</div>

	<?php 

	if($comissao){
		echo "</fieldset>";
		echo "<fieldset><legend>Verificação de reincidência</legend>";
		echo $form->radioButtonListRow($model, 'reincidencia', array(
        'Sim'=>'Sim',
        'Não'=>'Não',
    ));
	}

	if($diretor){
		echo "</fieldset>";
		echo "<fieldset><legend>Verificação de reincidência</legend>";
		echo $form->labelEx($model,'reincidencia'); 
		echo $model->reincidencia;
	}

	?>

	<?php 

	if($vis){
		echo "</fieldset>";
	}

	?>

	<?php 

	if($comissao){
		echo "<fieldset><legend>Parecer da Comissão Disciplinar Discente</legend>";
		$modelSansao = DSansaoAplicavel::model()->findAll(array('limit'=>4));
		$lista = CHtml::listData($modelSansao,'CDSansao', 'NMSansao');
		
		echo $form->radioButtonListInlineRow($model, 'SansaoAplicavel', $lista);
		echo "<br /><br />";
		echo $form->labelEx($model,'ParecerComissao');
		echo $form->textArea($model,'ParecerComissao', array('rows'=>5,'class'=>'span10'));
		echo "<br />Ainda restam <span id=\"left\"></span> caracteres a serem digitados.";
		echo $form->error($model,'ParecerComissao');
		
		echo "</fieldset>";

		?>
			<script type="text/javascript" >
			$('#DProcessoDisciplinar_ParecerComissao').limit('800','#left');
			</script>
		<?
	}

	if($diretor){

		echo "<fieldset><legend>Parecer da Comissão Disciplinar Discente</legend>";
		echo $form->labelEx($model,'SansaoAplicavel');
		echo $model->relSansao->NMSansao;
		echo "<br /><br />";
		echo $form->labelEx($model,'ParecerComissao');
		echo $model->ParecerComissao;
		
		
		echo "</fieldset>";


		echo "<fieldset><legend>Parecer Conclusivo do Diretor de Campus</legend>";
		$modelSansao = DSansaoAplicavel::model()->findAll();
		$lista = CHtml::listData($modelSansao,'CDSansao', 'NMSansao');
		
		echo $form->radioButtonListInlineRow($model, 'ParecerDiretor', $lista);
		echo "<br /><br />";
		echo $form->labelEx($model,'DescricaoParecer');
		echo $form->textArea($model,'DescricaoParecer', array('rows'=>5,'class'=>'span10'));
		echo "<br />Ainda restam <span id=\"left2\"></span> caracteres a serem digitados.";
		echo $form->error($model,'DescricaoParecer');
		
		echo "</fieldset>";

		?>
			<script type="text/javascript" >
			$('#DProcessoDisciplinar_DescricaoParecer').limit('200','#left2');
			</script>
		<?
	}

	?>


	<br />
	<?php 
		if($comissao){
			$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Atualizar Processo Disciplinar',
			'type'=>'primary',
			));
		}
		else if($diretor){
			$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Concluir Processo Disciplinar',
			'type'=>'primary',
			));
		}
		else{
			$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Criar Processo Disciplinar',
			'type'=>'primary',
			));
		}	
		?>
	

<?php $this->endWidget(); ?>

</div><!-- form -->

