<?php

require_once(dirname(dirname(__FILE__)).'/components/ConfigApp.php');

$configPam = new ConfigApp();
$host = $configPam->host;
$usuario = $configPam->usuario;
$password = $configPam->password;
$basedados = $configPam->basedados;
$smtp = $configPam->smtp;
$userSmtp = $configPam->userSmtp;
$passSmtp = $configPam->passSmtp;


Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de Documentos',
	'language' => 'pt_br',
	'defaultController'=>'site',
	'sourceLanguage' => 'pt_br',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'RecursosHumanos.models.Servidor',
		'RecursosHumanos.models.TecnicoAdministrativo',
		'RecursosHumanos.models.Professor',
		'RecursosHumanos.models.ProfessorEfetivo',
		'RecursosHumanos.models.ProfessorSubstituto',
		'RecursosHumanos.models.RH_ServidorStatus',
		'RecursosHumanos.models.RH_Cargo',
		'application.models.*',
		'application.components.*',
		'Requerimentos.models.Aluno',
		'Requerimentos.models.AlunoTecnico',
		'Requerimentos.models.AlunoGraduacao',
		'Requerimentos.models.CursoGraduacao',
		'Requerimentos.models.CursoTecnico',
		'MarcacaoProva.models.Turma',
		'application.extensions.yii-mail.*',

		'application.extensions.CAdvancedArBehavior',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
            	'bootstrap.gii',
        	),
		),
	),

	// application components
	'components'=>array(

		'mail' => array(
		        'class' => 'application.extensions.yii-mail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
		            'host'=>$smtp,
		            'username'=>$userSmtp,
		            'password'=>$passSmtp,
		            'port'=>'25',
		            //'encryption'=>'ssl',
		            ),
		        'viewPath' => 'application.views.mail',
		        'logging' => true,
		        'dryRun' => false
		  ),

		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),

		'urlManager'=>array(
		     'urlFormat'=>'path',
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
					'<action:(login|logout|page|contact)>' => 'site/<action>',
				),
		     'showScriptName'=>false,

		),

		'db'=>array(
			'connectionString' => 'mysql:host='.$host.';dbname='.$basedados,
			'emulatePrepare' => true,
			'username' => $usuario,
			'password' => $password,
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);