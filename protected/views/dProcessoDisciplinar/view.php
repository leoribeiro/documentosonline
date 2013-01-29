
<div id="titlePages">
		Processo Disciplinar #<?php echo $model->CDProcessoDisciplinar; ?>
</div>

<script>
function goBack()
  {
  window.history.back()
  }
</script>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDProcessoDisciplinar',
		array(
				'label'=>'Data da Ocorrência',
		        'type'=>'raw',
		        'value'=>@strftime('%d/%m/%Y', @strtotime($model->DataOcorrencia)),
		),
		//'DataOcorrencia',
		//'DataCriacao',
		'DescricaoOcorrencia',
	),
)); ?>
<br />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		array(
				'label'=>'Verificação de reincidências',
		        'type'=>'raw',
		        'value'=>'Não existe reincidência',
		),

	),
)); ?>
<br />
<h4>Parecer da Comissão Disciplinar Discente</h4>
<?php 
	if(empty($model->ParecerComissao)){
		echo "<i>Processo ainda não analisado pela comissão.</i><br />";
	}
	else{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'relSansao.NMSansao',
				'ParecerComissao',
			),
		));
	}	
	 ?>
<br />

<h4>Parecer Conclusivo do Diretor de Campus</h4>
<?php 
	if(empty($model->DescricaoParecer)){
		echo "<i>Processo ainda não analisado pelo diretor.</i><br />";
	}
	else{
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(

			'relSansaoDiretor.NMSansao',
			'DescricaoParecer',
		),
		)); 
	}
	?>
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Voltar',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>null, // null, 'large', 'small' or 'mini'
    'url'=>'javascript:goBack()',
)); ?>
