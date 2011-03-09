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
 * HTML5 Email Form Element
 *
 * @since Feb 18, 2011
 * @author Doug Hurst <dalan.hurst@gmail.com>
 * @link http://dev.w3.org/html5/markup/input.email.html
 */
class Mend_Form_Element_Email extends Zend_Form_Element_Xhtml
{

	/**
	 * Default form view helper to use for rendering
	 * @var string
	 */
	public $helper = 'formEmail';
}