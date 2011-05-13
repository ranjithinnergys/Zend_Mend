<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * HeadLink View Helper, Updated for HTML5
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 * @link       http://www.w3.org/TR/html5/semantics.html#the-link-element
 * @link       http://www.w3.org/TR/html5/elements.html#global-attributes
 * @uses       Zend_View_Helper_HeadLink
 */
class Mend_View_Helper_HeadLink extends Zend_View_Helper_HeadLink
{
    /**
     * $_validAttributes
     *
     * @var array
     */
    protected $_itemKeys = array(
        'disabled',
        'href',
        'hreflang',
        'id',
        'lang',
        'media',
        'rel',
        'relList',
        'rev',
        'sizes',
        'type',
        'title'
    );
}
