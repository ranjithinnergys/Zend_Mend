<?php
/**
 * Zend_Mend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 *
 * @category   Zend_Mend
 * @package    Form
 * @subpackage Element
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 */

/**
 * FlashMessenger View Helper
 *
 * @since Feb 18, 2011
 * @author Doug Hurst <dalan.hurst@gmail.com>
 */
class Mend_View_Helper_FlashMessages
{
	const HTML_ELEMENT = 'p';
	const BASE_CSS_CLASS = 'message';

	public function flashMessages()
	{
		$html = '';

		// Get messages
		$messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();

		// Process messages
		if (count($messages)) {
			foreach ($messages as $message) {
				//  Check to see if message is in the expected format
				if(!isset($message['type']) || !isset($message['message'])) continue;

				//  Compose CSS classes for element
				$cssClasses = array(self::BASE_CSS_CLASS);
				if(!is_numeric($message['type'])) $cssClasses[] = $message['type'];

				//  Compose HTML element
				$html .= '<'.self::HTML_ELEMENT.
					' class="'.implode(' ', $cssClasses).'">'.
					$message['message'].
					'</'.self::HTML_ELEMENT.'>';
			}

			return $html;
		}
	}
}