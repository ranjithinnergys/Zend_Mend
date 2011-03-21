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
 * Body Script
 *
 * Helper for setting and retrieving script elements for HTML body section
 *
 * @since Feb 18, 2011
 * @author Doug Hurst <doug@echoeastcreative.com>
 * @uses Zend_View_Helper_HeadScript
 */
class Mend_View_Helper_BodyScript extends Zend_View_Helper_HeadScript
{

    /**
     * Registry key for placeholder
     *
     * @var string
     */
    protected $_regKey = 'Mend_View_Helper_BodyScript';

    /**
     * Create script HTML
     *
     * @param  string $type
     * @param  array $attributes
     * @param  string $content
     * @param  string|int $indent
     * @return string
     */
    public function itemToString($item, $indent, $escapeStart, $escapeEnd)
    {
        $html = parent::itemToString($item, $indent, $escapeStart, $escapeEnd);
        return $html;
    }

    /**
     * Return bodyScript object
     *
     * Returns bodyScript helper object; optionally, allows specifying a script
     * or script file to include.
     *
     * @param  string $mode Script or file
     * @param  string $spec Script/url
     * @param  string $placement Append, prepend, or set
     * @param  array $attrs Array of script attributes
     * @param  string $type Script type and/or array of script attributes
     * @return Mend_View_Helper_BodyScript
     */
    public function bodyScript(
        $mode = Zend_View_Helper_HeadScript::FILE,
        $spec = null, $placement = 'APPEND',
        array $attrs = array(),
        $type = 'text/javascript')
    {
    	parent::headScript($mode, $spec, $placement, $attrs, $type);
        return $this;
    }
}
