<?php

namespace KERN23\XmlXpath\Mvc;

abstract class Cache {
	
	/**
	 * Loads and parses cached XML Data or reload them
	 *
	 * @param array $settings
	 * @return array
	 */
	public static function getCache(&$settings) {
		$cacheSettings = &$settings['cache.'];
		
		// Get the cacheFileName
		if ( is_array($cacheSettings['file.']) ) {
			$cacheFile = 'uploads/tx_xmlxpath/'.$GLOBALS['TSFE']->cObj->cObjGetSingle('TEXT', $cacheSettings['file.']);
		} else $cacheFile = 'uploads/tx_xmlxpath/'.$cacheSettings['file'];
		
		// Exist it?
		if ( file_exists($cacheFile) ) {
			$data = json_decode(file_get_contents($cacheFile), true);
			
			// Cache timed out?
			if ( $data['timeout'] >= time() ) {
				$data = $data['data'];
			} else {
				$data = static::loadAndCache($settings, $cacheFile, $cacheSettings);
			}
		} else {
			$data = static::loadAndCache($settings, $cacheFile, $cacheSettings);
		}
		
		return $data;
	}
	
	/**
	 * Load and cache a XML/HTML File
	 *
	 * @param array $settings
	 * @param string $cacheFile
	 * @param array $cacheSettings
	 * @return array
	 */
	public static function loadAndCache(&$settings, &$cacheFile, &$cacheSettings) {
		$data = static::loadAndParseExternal($settings);
		file_put_contents($cacheFile, json_encode(array('timeout' => time() + $cacheSettings['timeout'], 'data' => $data)));
		
		return $data;
	}
	
}