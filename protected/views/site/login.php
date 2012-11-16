
<div id="titlePages">Login</div>
<?php

	Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/serv-login.png"),'').'</div><div id="contentL"><h4>Servidores</h4> <br />Digitar como login a sua conta de e-mail seguido do caractere "underscore" e do grupo a que pertence.  Por exemplo, o usuario fulano@timoteo.cefetmg.br digitará como login fulano_timoteo e utilizará a senha do e-mail do CEFET-MG.   
	Para liberar o acesso ao sistema, entre em contato com o NTI. Tel: (31) 3845-4602 </div></div>');

?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>false, // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>false,'htmlOptions'=>array('style'=>'height:100px;')), // success, info, warning, error or danger
        ),

)); ?>

<div class="form" align="center">


<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>

	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 
	'label'=>'Entrar',
	'size'=>'large', 
	'type'=>'primary',
	)); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
