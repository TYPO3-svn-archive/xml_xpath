<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "xml_xpath".
 *
 * Auto generated 10-05-2014 09:02
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'XML xPath Parser',
	'description' => 'You can load a XML/HTML file or URL and parse it with XPATH or Regular Expressions. Output is possible with Fluid.',
	'category' => 'plugin',
	'shy' => false,
	'version' => '2.0.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => NULL,
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => true,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => false,
	'lockType' => '',
	'author' => 'Hendrik Reimers (kern23.de)',
	'author_email' => 'kontakt@kern23.de',
	'author_company' => 'KERN23.de',
	'CGLcompliance' => NULL,
	'CGLcompliance_note' => NULL,
	'constraints' => 
	array (
		'depends' => array(
			'extbase' => '6.0.0-6.2.99',
			'fluid' => '6.0.0-6.2.99',
			'typo3' => '6.0.0-6.2.99',
		),
		array (
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

?>