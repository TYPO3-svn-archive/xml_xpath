<?php

namespace KERN23\XmlXpath\Service;

class Html extends \KERN23\XmlXpath\Mvc\Cache {
	
	/**
	 * Loads and parses a external XML File/URL
	 *
	 * @param array $settings
	 * @return array
	 */
	public static function loadAndParseExternal(&$settings) {
		// Load URL or File?
		if ( $settings['source'] == 'URL' ) {
			$url    = $GLOBALS['TSFE']->cObj->cObjGetSingle('TEXT', $settings['source.']);
			$source = \KERN23\XmlXpath\Service\UrlFetcher::getUrl($url);
		} else {
			$source = $GLOBALS['TSFE']->cObj->cObjGetSingle($settings['source'], $settings['source.']);
		}
		
		if ( !$source ) return false;
		
		// Convert to XML Object
		preg_match_all($settings['expression.']['regexp'], $source, $data, PREG_SET_ORDER);
		
		// Enough data?
		if ( sizeof($data) <= 0 ) return false;
		
		// Limit them?
		if ( $settings['expression.']['limit'] > 0 )
			$data = array_slice($data, 0, $settings['expression.']['limit']);
		
		// Clear Memory
		unset($url, $source);
		
		// Return result
		return $data;
	}
	
}