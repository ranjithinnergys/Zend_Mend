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
 * 10-Digit Phone Number Formatter View Helper
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_View_Helper_Phonenumber extends Zend_View_Helper_Abstract
{

    /**
     * Generates an input type='tel' element
     *
     * @param string $phonenumber The phone number
     *
     * @return string
     */
    public function phonenumber($phonenumber)
    {
        assert('is_string($phonenumber)');
        if (strlen($phonenumber) == 10) {
            return '('.substr($phonenumber, 0, 3).')'
            	.' '.substr($phonenumber, 3, 3)
            	.'-'.substr($phonenumber, -4);
        } else {
            return $phonenumber;
        }
    }
}
