<div id="titlePages">
		Pré-visualização
</div>

<?php echo $this->renderPartial('//dDocumento/_viewPDFGoogle'); ?>


<script>
function goBack()
  {
  window.history.back()
  }
</script>


<div align="center">
<br />
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Alterar informações',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>$this->createUrl('/dDocumento/create',array('edit'=>'true')),
)); ?>

<?php 
    if(isset($editD)){
      $urlC = $this->createUrl('/dDocumento/createSave',array('editD'=>true));
    }
    else{
      $urlC = $this->createUrl('/dDocumento/createSave');  
    }
    
    $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Salvar documento',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>$urlC,
)); ?>
</div>
</p>