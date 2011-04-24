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
 * HTML5 Form Search Element View Helper
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_View_Helper_FormSearch extends Mend_View_Helper_FormHtml5Abstract
{
    /** @staticvar HTML5_TYPE input[type] introduced by HTML5 **/
    const HTML5_TYPE = 'search';

    /**
     * Generates an input type='search' element
     *
     * @param string|array $name    If a string, the element name.  If an
     * 	array, all other parameters are ignored, and the array elements
     * 	are used in place of added parameters
     * @param mixed        $value   The element value
     * @param array        $attribs Attributes for the element tag
     *
     * @return string The element HTML.
     */
    public function formSearch($name, $value = null, $attribs = null)
    {
        return parent::formHtml5($name, $value, $attribs);
    }
}
