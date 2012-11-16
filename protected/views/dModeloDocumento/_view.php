<?php
/* @var $this DModeloDocumentoController */
/* @var $data DModeloDocumento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDModeloDocumento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDModeloDocumento), array('view', 'id'=>$data->CDModeloDocumento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMModeloDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->NMModeloDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NumeracaoDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->NumeracaoDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMSiglaDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->NMSiglaDocumento); ?>
	<br />


</div>