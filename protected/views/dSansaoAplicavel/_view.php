<?php
/* @var $this DSansaoAplicavelController */
/* @var $data DSansaoAplicavel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDSansao')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDSansao), array('view', 'id'=>$data->CDSansao)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMSansao')); ?>:</b>
	<?php echo CHtml::encode($data->NMSansao); ?>
	<br />


</div>