<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Abstract Domain Model (Restrictive)
 *
 * This represents a domain model where all mutation (setting) is restricted
 * to protected and private access
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://martinfowler.com/eaaCatalog/domainModel.html
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
abstract class Mend_Model_RestrictiveDomainAbstract
extends Mend_Model_DomainAbstract
{

    /**
     * Magic Mutator
     *
     * @param string $name  Name of magic property
     * @param mixed  $value Value of magic property
     *
     * @return void
     * @throws LogicException
     */
    public function __set($name, $value)
    {
        throw new LogicException($name.' is a restricted property');
    }

    /**
     * Magic unset()
     *
     * @param string $name Name of magic property
     *
     * @return void
     * @throws LogicException
     */
    public function __unset($name)
    {
        throw new LogicException($name.' is a restricted property');
    }

    /**
     * Set an array value by offset
     *
     * @param int   $offset Array offset
     * @param mixed $value  Value to set
     *
     * @return void
     * @link http://www.php.net/manual/en/class.arrayaccess.php
     * @throws LogicException
     */
    public function offsetSet($offset, $value)
    {
        throw new LogicException($offset.' is a restricted property');
    }

    /**
     * Unset array offset
     *
     * @param int $offset Array offset
     *
     * @return void
     * @link http://www.php.net/manual/en/class.arrayaccess.php
     * @throws LogicException
     */
    public function offsetUnset($offset)
    {
        throw new LogicException($offset.' is a restricted property');
    }
}
