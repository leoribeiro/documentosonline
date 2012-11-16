<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'db'=>array(
				'connectionString' => 'mysql:host=127.0.0.1;dbname=ntiaplicacoes',
				'emulatePrepare' => true,
				'enableProfiling'=>true,
				'enableParamLogging'=>true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
			'log'=>array(
			        'class'=>'CLogRouter',
			        'routes'=>array(
			            array(
			                'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
			                // Access is restricted by default to the localhost
			                //'ipFilters'=>array('*'),
			            ),
			      ),
			),
		),
	)
);
