<div id="titlePages">
		Comissão Disciplinar - Análise de Processo Disciplinar
</div>



<?php 
	$isDirector = false;
	if(Yii::app()->user->checkAccess('ServidorDiretor')){
		$isDirector = true;
	}
	$isComissao = false;
	if(Yii::app()->user->checkAccess('ServidorComissao')){
		$isComissao = true;
	}
	if($isComissao){
		echo $this->renderPartial('_form', array('model'=>$model,'comissao'=>true));
	}
	else if($isDirector){
		echo $this->renderPartial('_form', array('model'=>$model,'diretor'=>true)); 
	}
	


?>