<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Controllers
 * @subpackage Plugins
 * @author     Doug Hurst <doug@echoeastcreative.com>
 * @copyright  2011 Echo East Creative, LLC
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       https://github.com/echoeastcreative/Zend_Mend
 */

/**
 * HTML5 Email Form Element
 *
 * @category   Zend_Mend
 * @package    Forms
 * @subpackage Elements
 * @author     Doug Hurst <doug@echoeastcreative.com>
 * @copyright  2011 Echo East Creative, LLC
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://dev.w3.org/html5/markup/input.email.html
 * @link       https://github.com/echoeastcreative/Zend_Mend
 */
class Mend_Form_Element_Email extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formEmail';
}
