<?php

namespace KERN23\XmlXpath\Service;

class Xml extends \KERN23\XmlXpath\Mvc\Cache {
	
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
		$data = self::convertToXML($source);
		
		// Enough data?
		if ( $data->count() <= 0 ) return false;
		
		// Take a look inside with XPATH and make them to an array
		if ( $settings['xpath.']['path'] )
			$data = $data->xpath($settings['xpath.']['path']);
		
		// Convert to array
		$data = self::xml2array($data);
		
		// Limit them?
		if ( $settings['xpath.']['limit'] > 0 )
			$data = array_slice($data, 0, $settings['xpath.']['limit']);
		
		// Clear Memory
		unset($url, $source);
		
		// Return result
		return $data;
	}
	
    /**
	 * Converts a string to XML
	 *
	 * @param string $string
	 * @return \SimpleXMLElement
	 */
	protected static function convertToXML(&$string) {
		# Boring Namespace Conversion
		$string = str_replace("xmlns=","ns=", $string);
		$string = str_replace("xmlns:","ns:", $string);
		
		# Create the XML Object
		if ( strlen($string) <= 0 ) return false;
		$xml = @simplexml_load_string($string);
		if ( !$xml ) return false;
		$xml = new \SimpleXMLElement(@$xml->asXML());
		
		# Register the Namespaces
		$namespaces = @$xml->getNamespaces(true);
		if ( sizeof($namespaces) > 0 ) {
			foreach ($namespaces as $prefix => $ns) {
				@$xml->registerXPathNamespace($prefix, $ns);
			}
		}
		unset($namespaces);
		
		# Return
		return $xml;
	}
	
	/**
	 * Converts a XML Object to an Array
	 *
	 * @param mixed $xmlObject
	 * @return array
	 */
	protected static function xml2array($xmlObject) {
		return self::flattenArray(json_decode(json_encode($xmlObject), TRUE));
	}
	
	/**
	 * Modifies the array recursively to simplify it
	 * used by xml2array only
	 *
	 * @param array $input
	 * @return array
	 */
	protected static function flattenArray(array $input) {
		$return = array();
		
		foreach ($input as $key => $value) {
			// Remove the @ chars like @attributes
			if ( strpos($key, '@') === 0)
				$key = substr($key, 1);
			
			// Remove empty arrays or recursively flatten them
			if ( is_array($value) && (sizeof($value) > 0) ) {
				$value = self::flattenArray($value); 
			} elseif ( is_array($value) && (sizeof($value) <= 0) ) {
				$value = '';
			}
			
			$return[$key] = $value;
		}
		
		return $return;
	}
}