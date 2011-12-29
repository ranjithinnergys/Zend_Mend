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
 * US Federal Employee Identification Number (FEIN) Formatter View Helper
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_View_Helper_Usfein extends Zend_View_Helper_Abstract
{

    /**
     * Formats a US FEIN
     *
     * @param string $fein The FEIN
     *
     * @return string
     */
    public function usfein($fein)
    {
        assert('is_string($fein)');
        return substr($fein, 0, 2)
            .'-'
            .substr($fein, 2);
    }
}
