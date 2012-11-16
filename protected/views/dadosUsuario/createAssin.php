<div id="titlePages">
		Dados do Usuário
</div>

<?php
if(isset($success)){
	$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    ));
	Yii::app()->user->setFlash('success', '<strong>Pronto!</strong> Informações atualizadas!');
}
?>

<?php echo $this->renderPartial('//dadosUsuario/_form', array('model'=>$model)); ?>