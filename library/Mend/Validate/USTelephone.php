<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Util
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * North American Numbering Plan (NANP) Validator
 *
 * Implemented while waiting on Zend_Validate_Phone to be released.
 *
 * @category  Zend_Mend
 * @package   Validators
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 * @link      http://framework.zend.com/wiki/display/ZFPROP/Zend_Validate_Phone+-+Thomas+Weidner
 * @link      http://en.wikipedia.org/wiki/North_American_Numbering_Plan
 */
class Mend_Validate_USTelephone extends Zend_Validate_Abstract
{
    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return boolean
     * @throws Zend_Validate_Exception If validation of $value is impossible
     */
    public function isValid($value)
    {
        //  NANP Pattern, modified slightly from:
        //  @link http://blog.stevenlevithan.com/archives/validate-phone-number#r4-2-v-leading1
        $pattern = '/^((?:\+?1[-. ]?)?\(?([0-9]{3})\)?[-. ]?)?([0-9]{3})[-. ]?([0-9]{4})$/';

        return preg_match($pattern, $value) == 1;
    }
}