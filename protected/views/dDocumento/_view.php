<?php
/* @var $this DDocumentoController */
/* @var $data DDocumento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDDocumento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDDocumento), array('view', 'id'=>$data->CDDocumento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Assunto')); ?>:</b>
	<?php echo CHtml::encode($data->Assunto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Corpo')); ?>:</b>
	<?php echo CHtml::encode($data->Corpo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataCriacao')); ?>:</b>
	<?php echo CHtml::encode($data->DataCriacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->DataDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModeloDocumento_CDModeloDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->ModeloDocumento_CDModeloDocumento); ?>
	<br />


</div>