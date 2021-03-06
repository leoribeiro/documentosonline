<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title>Sistema de Documentos OnLine</title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::image($this->createUrl('/images/DocumentosOnline.png'),'Sistema de Controle de Cocumentos',array('title'=>'Sistema de Controle de Documentos')); ?></div>
		<div id="subtitle">
			<?php echo CHtml::image($this->createUrl('/images/cefet.jpg'),'CEFET-MG Campus Timóteo',array('title'=>'CEFET-MG Campus Timóteo')); ?>
		</div>
	</div><!-- header -->

	<?php

	$user = Yii::app()->user;
	$isGuest = Yii::app()->user->isGuest;
	$isAdmin = (Yii::app()->user->name == "admin");
	$isUserPriv = false;
	if(Yii::app()->user->checkAccess('visualizacao') && !$isGuest){
		$isUserPriv = true;
	}
	$isDirector = false;
	if(Yii::app()->user->checkAccess('ServidorDiretor') && !$isGuest){
		$isDirector = true;
	}
	$isComissao = false;
	if(Yii::app()->user->checkAccess('ServidorComissao') && !$isGuest){
		$isComissao = true;
	}
	$isPD = false;
	if(Yii::app()->user->checkAccess('ServidorPD') && !$isGuest){
		$isPD = true;
	}


	
	$this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, // whether this is a stacked menu
	    'items'=>array(
	        // array('label'=>'Início', 'url'=>array('/Site/index'),'visible'=>!$isGuest),
	        array('label'=>'Novo documento', 'url'=>array('/dDocumento/create'),'visible'=>($isUserPriv && !$isAdmin)),
	        array('label'=>'Novo processo', 'url'=>array('/dProcessoDisciplinar/create'),'visible'=>($isPD && !$isAdmin)),
	        array('label'=>'Histórico', 'url'=>'#',
	        	'items'=>array(
	                         array('label'=>'Meus documentos', 'url'=>array('/dDocumento/admin'),'visible'=>($isUserPriv)),
	                         array('label'=>'Meus Processos', 'url'=>array('/dProcessoDisciplinar/admin'),'visible'=>($isPD)),
	                      ),'visible'=>(($isUserPriv || $isPD) && !$isAdmin)
	        ),
	        array('label'=>'Minha assinatura', 'url'=>array('/dDocumento/createAssin'),'visible'=>($isUserPriv && !$isAdmin)),
	        
	        array('label'=>'Administração', 'url'=>'#',
	        	'items'=>array(
	                         
	                         array('label'=>'Documentos Oficiais', 'url'=>array('/Site/index')),
	                         array('label'=>'Processos Disciplinares', 'url'=>array('/dProcessoDisciplinar/adminProcessos'),'visible'=>($isAdmin)),
	                         array('label'=>'Modelos de Documentos', 'url'=>array('/dModeloDocumento/admin')),
	                         array('label'=>'Processo Disciplinar', 'url'=>array('/dConfProcessoDisciplinar/create')),

	        ),'visible'=>(!$isGuest && $isAdmin)),
	        array('label'=>'Processos da Direção', 'url'=>array('/dProcessoDisciplinar/adminProcessos'),'visible'=>($isDirector && !$isAdmin)),
	        array('label'=>'Processos da Comissão', 'url'=>array('/dProcessoDisciplinar/adminProcessos'),'visible'=>($isComissao && !$isAdmin)),
	        array('label'=>'Regime disciplinar', 'url'=>array('/dProcessoDisciplinar/info'),'visible'=>(($isDirector || $isComissao || $isPD) && !$isAdmin)),
	        
	        array('label'=>'Login', 'url'=>array('/Site/login'), 'visible'=>$isGuest),
			array('label'=>'Sair ('.Yii::app()->user->name.')', 'url'=>array('/Site/logout'), 'visible'=>!$isGuest),
	    ),
	)); ?>

	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo CHtml::image($this->createUrl('/images/nti.jpg'), 'Núcleo de Tecnologia da Informação',array('title'=>'Núcleo de Tecnologia da Informação (nti@timoteo.cefetmg.br)')); ?>
		<strong>NTI - Núcleo de Tecnologia da Informação</strong> <br /> 

		CEFET-MG Campus Timóteo - <?php echo date('Y'); ?> <br />
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
