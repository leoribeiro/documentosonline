<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de Documentos',
	'language' => 'pt_br',
	'sourceLanguage' => 'pt_br',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'RecursosHumanos.models.*',
		
		'Requerimentos.models.Aluno',
		'Requerimentos.models.AlunoTecnico',
		'Requerimentos.models.AlunoGraduacao',
		'Requerimentos.models.CursoGraduacao',
		'Requerimentos.models.CursoTecnico',
		'MarcacaoProva.models.Turma',

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

		'bootstrap'=>array(
        	'class'=>'ext.bootstrap.components.Bootstrap',
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
		     //'caseSensitive'=>false, 
      
		),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ntiaplicacoes',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'n2t0i11',
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