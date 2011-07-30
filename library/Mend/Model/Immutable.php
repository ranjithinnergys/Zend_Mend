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
    public final function exchangeArray($input)
    {
    }

    /**
     * @see ArrayObject::offsetSet()
     */
    public final function offsetSet($index, $newval)
    {
    }

    /**
     * @see ArrayObject::offsetUnset()
     */
    public final function offsetUnset($index)
    {
    }

    /**
     * Disable Magic Accessor
     */
    final public function __get($name)
    {
    }

    /**
     * Disable Magic Mutator
     */
    final public function __set($name, $value)
    {
    }

    /**
     * Do not trigger error on echo
     */
    public function __toString()
    {
        echo get_class($this);
    }
}