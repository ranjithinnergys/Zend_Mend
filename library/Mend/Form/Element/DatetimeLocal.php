<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Controllers
 * @subpackage Plugins
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * HTML5 Datetime-Local Form Element
 *
 * @category   Zend_Mend
 * @package    Forms
 * @subpackage Elements
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://dev.w3.org/html5/markup/input.datetime-local.html
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Form_Element_DatetimeLocal extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formDatetimeLocal';
}
