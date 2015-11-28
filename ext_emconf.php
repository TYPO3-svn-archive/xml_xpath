<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "xml_xpath".
 *
 * Auto generated 17-11-2014 09:21
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'XML xPath Parser',
	'description' => 'You can load a XML/HTML file or URL and parse it with XPATH or Regular Expressions. Output is possible with Fluid.',
	'category' => 'plugin',
	'version' => '2.1.0',
	'state' => 'beta',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => false,
	'author' => 'Hendrik Reimers (kern23.de)',
	'author_email' => 'kontakt@kern23.de',
	'author_company' => 'KERN23.de',
	'constraints' => 
	array (
		'depends' => 
		array (
			'extbase' => '6.2.0-7.6.99',
			'fluid' => '6.2.0-7.6.99',
			'typo3' => '6.2.0-7.6.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

