<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.12/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/desenv.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

$projetoRH = 'ProjetoRH';
$projetoReq = 'ProjetoRequerimentos';
$projetoMarc = 'ProjetoMarcacao';

Yii::setPathOfAlias('RecursosHumanos','../'.$projetoRH.'/protected');
Yii::setPathOfAlias('Requerimentos','../'.$projetoReq.'/protected');
Yii::setPathOfAlias('MarcacaoProva','../'.$projetoMarc.'/protected');

Yii::createWebApplication($config)->run();
