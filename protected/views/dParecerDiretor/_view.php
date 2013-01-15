<?php
/* @var $this DParecerDiretorController */
/* @var $data DParecerDiretor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDParecer')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDParecer), array('view', 'id'=>$data->CDParecer)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMParecer')); ?>:</b>
	<?php echo CHtml::encode($data->NMParecer); ?>
	<br />


</div>