<?php
namespace KERN23\XmlXpath\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Hendrik Reimers <kontakt@kern23.de>, KERN23.de
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package xml_xpath
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class XpathController extends \KERN23\XmlXpath\Mvc\Controller\ActionController {
	
	/**
	 * action render
	 *
	 * @return void
	 */
	public function renderXmlAction() {
		// Load individual View (like set in settings)
		$this->view = $this->getStandaloneView($this->settings['templateFile'], $this->configurationManager);
		
		// Load the Data
		if ( $this->settings['cache.']['enable'] == 1 ) {
			$data = \KERN23\XmlXpath\Service\Xml::getCache($this->settings);
		} else $data = \KERN23\XmlXpath\Service\Xml::loadAndParseExternal($this->settings);
		
		// Put it to the Fluid
		$this->view->assign('xml', $data);
	}
	
	/**
	 * action render
	 *
	 * @return void
	 */
	public function renderHtmlAction() {
		// Load individual View (like set in settings)
		$this->view = $this->getStandaloneView($this->settings['templateFile'], $this->configurationManager);
		
		if ( is_array($this->settings['expression.']['regexp.']) ) {
			$typoScriptService                       = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Service\\TypoScriptService');
			$this->settings['expression.']['regexp'] = $this->configurationManager->getContentObject()->cObjGetSingle($this->settings['expression.']['regexp'], $this->settings['expression.']['regexp.']);
			
			unset($this->settings['expression.']['regexp.']);
		}
		
		// Load the Data
		if ( $this->settings['cache.']['enable'] == 1 ) {
			$data = \KERN23\XmlXpath\Service\Html::getCache($this->settings);
		} else $data = \KERN23\XmlXpath\Service\Html::loadAndParseExternal($this->settings);
		
		// Put it to the Fluid
		$this->view->assign('html', $data);
	}
	
}
?>