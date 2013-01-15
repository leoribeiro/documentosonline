<?php
/* @var $this DProcessoDisciplinarController */
/* @var $data DProcessoDisciplinar */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDProcessoDisciplinar')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDProcessoDisciplinar), array('view', 'id'=>$data->CDProcessoDisciplinar)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataOcorrencia')); ?>:</b>
	<?php echo CHtml::encode($data->DataOcorrencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataCriacao')); ?>:</b>
	<?php echo CHtml::encode($data->DataCriacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DescricaoOcorrencia')); ?>:</b>
	<?php echo CHtml::encode($data->DescricaoOcorrencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ParecerComissao')); ?>:</b>
	<?php echo CHtml::encode($data->ParecerComissao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SansaoAplicavel')); ?>:</b>
	<?php echo CHtml::encode($data->SansaoAplicavel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ParecerDiretor')); ?>:</b>
	<?php echo CHtml::encode($data->ParecerDiretor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DescricaoParecer')); ?>:</b>
	<?php echo CHtml::encode($data->DescricaoParecer); ?>
	<br />

	*/ ?>

</div>