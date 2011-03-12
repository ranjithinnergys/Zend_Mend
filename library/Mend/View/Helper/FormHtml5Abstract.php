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
 * HTML5 Form Element Input Abstract Helper
 *
 * @since Feb 19, 2011
 * @author Doug Hurst <dalan.hurst@gmail.com>
 */
abstract class Mend_View_Helper_FormHtml5Abstract extends Zend_View_Helper_FormElement
{
    /** @staticvar HTML5_TYPE input[type] introduced by HTML5 **/
    const HTML5_TYPE = 'text';

    /** @staticvar Legacy fallback type **/
    const FALLBACK_TYPE = 'text';

    /**
     * Generates an input type='email' element
     *
     * @param string|array $name If a string, the element name.  If an
     * array, all other parameters are ignored, and the array elements
     * are used in place of added parameters.
     *
     * @param mixed $value The element value.
     *
     * @param array $attribs Attributes for the element tag.
     *
     * @return string The element HTML.
     */
    public function formHtml5($name, $value = null, $attribs = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info);

        /** Set disabled property */
        $disabled = '';
        if ($disable) $disabled = ' disabled="disabled"';

        /** Set correct end tag for XHTML or HTML */
        $endTag = ' />';
        if (
            $this->view instanceof Zend_View_Abstract &&
            !$this->view->doctype()->isXhtml()
        ) $endTag = '>';

        /**
         * Set input[type]
         *
         * Will fallback to input[type=text] if the doctype is not HTML5
         */
        $inputType = self::FALLBACK_TYPE;
        if(
            $this->view instanceof Zend_View_Abstract &&
            $this->view->doctype()->isHtml5()
        ) $inputType = self::HTML5_TYPE;

        $html = '<input type="'.$inputType.'"'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . ' value="' . $this->view->escape($value) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag;

        return $html;
    }
}
