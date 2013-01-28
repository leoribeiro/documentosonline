	<div class="row">
		<?php echo $form->labelEx($model,'ParecerComissao'); ?>
		<?php echo $form->textArea($model,'ParecerComissao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ParecerComissao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SansaoAplicavel'); ?>
		<?php echo $form->textField($model,'SansaoAplicavel'); ?>
		<?php echo $form->error($model,'SansaoAplicavel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ParecerDiretor'); ?>
		<?php echo $form->textField($model,'ParecerDiretor'); ?>
		<?php echo $form->error($model,'ParecerDiretor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescricaoParecer'); ?>
		<?php echo $form->textArea($model,'DescricaoParecer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DescricaoParecer'); ?>
	</div>