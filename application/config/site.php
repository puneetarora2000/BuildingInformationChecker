<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//adding config items.
$config['site'] = array(

	// Site name
	'name' => 'Rule Engine(s) : By Raninder Kaur',

	'short_name' => 'Raninder Kaur',

	// Default page title
	// (set empty then MY_Controller will automatically generate one according to controller / action)
	'title' => '',

	'email' => 'RaninderD@gmail.com',

	'phone' => '+1 16722970033',

	// Multilingual settings (set empty array to disable this)
	'multilingual' => array(	// language files to autoload
	),

	// Google Analytics User ID (UA-XXXXXXXX-X)
	'ga_id' => '',
	
	// Menu items
	// 
	'admin_menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
		),

		'data' => array(
			'name'		=> 'Pre-Feed Data',
			'url'		=> 'admin/data',
			'children'  => array(
				'Modules'=>'admin/data/modules', 
				'Project Configration'	=> 'admin/data/projects',
				'Site/Location'	=> 'admin/data/site',
				'Building'	=> 'admin/data/buildings',
				'Structure Elements'	=> 'admin/data/elements',
				'Structure Units'	=> 'admin/data/structureunits',
				'Structureattributes' => 'admin/data/structureattributes',
			//	'Structuredetails'=>'admin/data/structuredetails',
				'IfcDataBase'=>'admin/data/modelfiledb',
			)
		),


		'farmerslist' => array(
			'name'		=> 'Rule Engine',
			'url'		=> 'admin/data/rules',
		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
		'children'  => array(
				'Reference IS Code Book'	=> 'admin/data/iscodebook',
				'Rule Set'	=> 'admin/data/ruleset',
				'Rule Types'	=> 'admin/data/ruletype',
				'Rule Names'	=> 'admin/data/rule',
				'Rule Construction' => 'admin/data/ruleinputparameters',
				//'Condition Script'=>'admin/data/condition_script',
				//'Consequence Script'=>'admin/data/consequence_script',
				'Export Ruleset CSV'=>'admin/data/exportrules',
				
			)

		),

		'receipts' => array(
			'name'		=> 'Report Management',
			'url'		=> 'admin/inspections/receipts',
			'children'  => array(
				'Reporting Issues Codes'	=> 'admin/data/issuetypes',
				'DataBaseAccess'	=> '/phpmyadmin/',
				'DataBackup'=>'admin/data/takeBackup',
								
			)
		),

		 		 
		 
		'inspections' => array(
			'name'		=> 'User Managements',
			'url'		=> '',
		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
			'children'  => array(
				'Users'	=> 'admin/data/users',
				'Groups'	=> 'admin/data/groups',
				//'Year'	=> 'admin/data/year',
				//'Menus'	=> 'admin/data/menus'
				
			)
		),
		 
	 

	),
	'seed_producer_menu' => array(

		'farmerslist' => array(
			'name'		=> 'Farmers List',
			'url'		=> 'admin/farmers',
		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
		),
		
		'addperforma' => array(
			'name'		=> 'Add Performa',
			'url'		=> 'forms',
		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
			'children'  => array(
				'Performa A'	=> 'admin/forms/performaa/add',
				'Performa B'	=> 'admin/forms/performab/add',
				'Performa C'	=> 'admin/forms/performac/add'
				
			)
		),
		'myperformas' => array(
			'name'		=> 'My Performas',
			'url'		=> 'admin/myperformas',
			'children'  => array(
				'Performa A'	=> 'admin/myperformas/performaa',
				'Performa B'	=> 'admin/myperformas/performab',
				'Performa C'	=> 'admin/myperformas/performac'
				
			)
		),
		'myinspections' => array(
			'name'		=> 'My Inspections',
			'url'		=> 'admin/myreports/inspections',
		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
		),
		'myreports' => array(
			'name'		=> 'My Inspection Reports',
			'url'		=> 'admin/myreports',
			'children'  => array(
				'Performa A'	=> 'admin/myreports/performaa',
				'Performa B'	=> 'admin/myreports/performab',
				'Performa C'	=> 'admin/myreports/performac'
				
			)
		),
		'samplereports' => array(
			'name'		=> 'Seed Sample Reports',
			'url'		=> 'admin/seedsamples/reports',
		),

	),
	'accounts_menu' => array(
		
		'receipts' => array(
			'name'		=> 'Receipts Received',
			'url'		=> 'admin/inspections/receipts',
			'children'  => array(
				'Performa A'	=> 'admin/receipts/performaa',
				'Performa B'	=> 'admin/receipts/performab',
				'Performa C'	=> 'admin/receipts/performac'
				
			)
		),

	),
	'inspector_menu' => array(
		
		'receiptsapproved' => array(
			'name'		=> 'Receipts Approved',
			'url'		=> 'admin/inspections/receipts'
		),
		'inspections' => array(
			'name'		=> 'Inspection Stages',
			'url'		=> 'admin/inspections',
		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
			'children'  => array(
				'First Inspection'	=> 'admin/inspections/firstinspection',
				'Second Inspection'	=> 'admin/inspections/secondinspection',
				'Third Inspection'	=> 'admin/inspections/thirdinspection',
				'Fourth Inspection'	=> 'admin/inspections/fourthinspection'
				
			)
		),
		'seedproducers' => array(
			'name'		=> 'Seed Producer List',
			'url'		=> 'admin/seedproducers',
		),
		'seedsampleresult' => array(
			'name'		=> 'Seed Samples Producerwise List',
			'url'		=> 'admin/seedsamples/seedproducers',
		),

	),
// =======
// <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// //adding config items.
// $config['site'] = array(

// 	// Site name
// 	'name' => 'Rule Engine(s) : By Raninder Kaur',

// 	'short_name' => 'Raninder Kaur',

// 	// Default page title
// 	// (set empty then MY_Controller will automatically generate one according to controller / action)
// 	'title' => '',

// 	'email' => 'RaninderD@gmail.com',

// 	'phone' => '+1 16722970033',

// 	// Multilingual settings (set empty array to disable this)
// 	'multilingual' => array(	// language files to autoload
// 	),

// 	// Google Analytics User ID (UA-XXXXXXXX-X)
// 	'ga_id' => '',
	
// 	// Menu items
// 	// 
// 	'admin_menu' => array(
// 		'home' => array(
// 			'name'		=> 'Home',
// 			'url'		=> '',
// 		),

// 		'data' => array(
// 			'name'		=> 'Pre-Feed Data',
// 			'url'		=> 'admin/data',
// 			'children'  => array(
// 				'Modules'=>'admin/data/modules', 
// 				'Project Configration'	=> 'admin/data/projects',
// 				'Site/Location'	=> 'admin/data/site',
// 				'Building'	=> 'admin/data/buildings',
// 				'Structure Elements'	=> 'admin/data/elements',
// 				'Structure Units'	=> 'admin/data/structureunits',
// 				'Structureattributes' => 'admin/data/structureattributes',
// 			//	'Structuredetails'=>'admin/data/structuredetails',
// 				'IfcDataBase'=>'admin/data/modelfiledb',
// 			)
// 		),


// 		'farmerslist' => array(
// 			'name'		=> 'Rule Engine',
// 			'url'		=> 'admin/data/rules',
// 		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
// 		'children'  => array(
// 				'Reference IS Code Book'	=> 'admin/data/iscodebook',
// 				'Rule Set'	=> 'admin/data/ruleset',
// 				'Rule Types'	=> 'admin/data/ruletype',
// 				'Rule Names'	=> 'admin/data/rule',
// 				'Rule Input Parameters' => 'admin/data/ruleinputparameters',
// 				'Condition Script'=>'admin/data/condition_script',
// 				'Consequence Script'=>'admin/data/consequence_script',
// 				'Make & Export Ruleset'=>'admin/data/exportrules',
// 				'DataBackup'=>'admin/data/takeBackup',
// 			)

// 		),

// 		'receipts' => array(
// 			'name'		=> 'Report Management',
// 			'url'		=> 'admin/inspections/receipts',
// 			'children'  => array(
// 				'IssuesDefinations'	=> 'admin/data/issuetypes',
// 				'DataBaseAccess'	=> '/phpmyadmin/',
// 				'Report A'	=> '/rerpor/',
								
// 			)
// 		),

		 		 
		 
// 		'inspections' => array(
// 			'name'		=> 'User Managements',
// 			'url'		=> '',
// 		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
// 			'children'  => array(
// 				'Users'	=> 'admin/data/users',
// 				'Groups'	=> 'admin/data/groups',
// 				//'Year'	=> 'admin/data/year',
// 				//'Menus'	=> 'admin/data/menus'
				
// 			)
// 		),
		 
	 

// 	),
// 	'seed_producer_menu' => array(

// 		'farmerslist' => array(
// 			'name'		=> 'Farmers List',
// 			'url'		=> 'admin/farmers',
// 		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
// 		),
		
// 		'addperforma' => array(
// 			'name'		=> 'Add Performa',
// 			'url'		=> 'forms',
// 		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
// 			'children'  => array(
// 				'Performa A'	=> 'admin/forms/performaa/add',
// 				'Performa B'	=> 'admin/forms/performab/add',
// 				'Performa C'	=> 'admin/forms/performac/add'
				
// 			)
// 		),
// 		'myperformas' => array(
// 			'name'		=> 'My Performas',
// 			'url'		=> 'admin/myperformas',
// 			'children'  => array(
// 				'Performa A'	=> 'admin/myperformas/performaa',
// 				'Performa B'	=> 'admin/myperformas/performab',
// 				'Performa C'	=> 'admin/myperformas/performac'
				
// 			)
// 		),
// 		'myinspections' => array(
// 			'name'		=> 'My Inspections',
// 			'url'		=> 'admin/myreports/inspections',
// 		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
// 		),
// 		'myreports' => array(
// 			'name'		=> 'My Inspection Reports',
// 			'url'		=> 'admin/myreports',
// 			'children'  => array(
// 				'Performa A'	=> 'admin/myreports/performaa',
// 				'Performa B'	=> 'admin/myreports/performab',
// 				'Performa C'	=> 'admin/myreports/performac'
				
// 			)
// 		),
// 		'samplereports' => array(
// 			'name'		=> 'Seed Sample Reports',
// 			'url'		=> 'admin/seedsamples/reports',
// 		),

// 	),
// 	'accounts_menu' => array(
		
// 		'receipts' => array(
// 			'name'		=> 'Receipts Received',
// 			'url'		=> 'admin/inspections/receipts',
// 			'children'  => array(
// 				'Performa A'	=> 'admin/receipts/performaa',
// 				'Performa B'	=> 'admin/receipts/performab',
// 				'Performa C'	=> 'admin/receipts/performac'
				
// 			)
// 		),

// 	),
// 	'inspector_menu' => array(
		
// 		'receiptsapproved' => array(
// 			'name'		=> 'Receipts Approved',
// 			'url'		=> 'admin/inspections/receipts'
// 		),
// 		'inspections' => array(
// 			'name'		=> 'Inspection Stages',
// 			'url'		=> 'admin/inspections',
// 		//	'icon'		=> 'ion ion-gear-b',	// use non-FontAwesome icon (with "icon" class to align styling)
// 			'children'  => array(
// 				'First Inspection'	=> 'admin/inspections/firstinspection',
// 				'Second Inspection'	=> 'admin/inspections/secondinspection',
// 				'Third Inspection'	=> 'admin/inspections/thirdinspection',
// 				'Fourth Inspection'	=> 'admin/inspections/fourthinspection'
				
// 			)
// 		),
// 		'seedproducers' => array(
// 			'name'		=> 'Seed Producer List',
// 			'url'		=> 'admin/seedproducers',
// 		),
// 		'seedsampleresult' => array(
// 			'name'		=> 'Seed Samples Producerwise List',
// 			'url'		=> 'admin/seedsamples/seedproducers',
// 		),

// 	),
// >>>>>>> ab9252384843e7a623a1478dfd7a2d34aeed0c6e
 );