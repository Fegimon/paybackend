<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PayRentz',
	'environment'=>'development',//development,testing,production
	'components'=>array(
        /*'eauth' => array(
            'services' => array( // You can change the providers and their classes.
                'google' => array(
                    // register your app here: https://code.google.com/apis/console/
                    'client_id' => '...',
                    'client_secret' => '...',
                ),
                'facebook' => array(
                    // register your app here: https://developers.facebook.com/apps/
                    'client_id' => '294592500690677',
                    'client_secret' => '5c738215b8377f73f4d4a4555f099992',
                ),

            ),
        ),*/			
		'db'=>array(
			'host' => 'localhost',
			'dbname' => 'payrentz',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
	),
	'page'=>array(
					'response'=>true,//page rendered timing in seconds and memory usage
					),
	// application-level parameters that can be accessed
	'pageing'=>array('products'=>16),
	'params'=>array(
		// this is used in contact page
		'SaltKey'=>'MirrormindsCrypt',
		'adminEmail'=>'',
		'supportEmail'=>'',
	),
);?>