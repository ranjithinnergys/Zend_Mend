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
 * Generic Immutable Object
 *
 * @category  Zend_Mend
 * @package   Model
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Model_Immutable extends ArrayObject
{
    /**
     * @see ArrayObject::__construct()
     */
    public function __construct($input)
    {
        parent::__construct((object) $input, self::ARRAY_AS_PROPS);
    }

    /**
     * @see ArrayObject::exchangeArray()
     */
    public function exchangeArray($input)
    {
        throw new LogicException(__CLASS__.' cannot be changed after instantiation.');
    }

    /**
     * @see ArrayObject::offsetSet()
     */
    public function offsetSet($index, $newval)
    {
        throw new LogicException(__CLASS__.' cannot be changed after instantiation.');
    }

    /**
     * @see ArrayObject::offsetUnset()
     */
    public function offsetUnset($index)
    {
        throw new LogicException(__CLASS__.' cannot be changed after instantiation.');
    }
}