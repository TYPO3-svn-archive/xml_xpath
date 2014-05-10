<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'KERN23.'.$_EXTKEY,
	'Pi1',
	array(
		'Xpath' => 'renderXml',
	),
	// non-cacheable actions
	array(
		
	)
);

?>