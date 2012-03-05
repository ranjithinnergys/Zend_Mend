<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage DTO
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Abstract Data Transfer Object
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage DTO
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
abstract class Mend_Model_DTO_Abstract
{
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