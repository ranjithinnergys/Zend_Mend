<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage Enum
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Abstract Enumeration
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage Enum
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
abstract class Mend_Model_Enum_Abstract
{
    /**
     * Enum->toArray() using reflection and late static binding
     *
     * @return array
     */
    final public static function toArray()
    {
        $reflection = new ReflectionClass(get_called_class());
        return $reflection->getConstants();
    }

    /**
     * Disable Construction
     */
    final private function __construct()
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
}