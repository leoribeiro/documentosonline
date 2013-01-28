<?php
/* @var $this DConfProcessoDisciplinarController */
/* @var $data DConfProcessoDisciplinar */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDConf')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDConf), array('view', 'id'=>$data->CDConf)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Servidor_Diretor')); ?>:</b>
	<?php echo CHtml::encode($data->Servidor_Diretor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Servidor_Comissao')); ?>:</b>
	<?php echo CHtml::encode($data->Servidor_Comissao); ?>
	<br />


</div>