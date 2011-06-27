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
 * Abstract Builder
 *
 * @category  Zend_Mend
 * @package   Model
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
abstract class Mend_Model_Builder
{
    /**
     * @var array Data collected by builder
     */
    private $_data = array();

    /**
     * Private Constructor
     */
    private function __construct()
    {
    }

    /**
     * Singleton Accessor
     */
    public static function getBuilder()
    {
        return new self;
    }

    /**
     * Configure Magic Function Call
     *
     * This should be enough to capture simple $b->withPropertyName($value)
     * type calls. Anything more complex will need to be extended.
     *
     * @param $name      string Name of function to call
     * @param $arguments array  Set of arguments
     *
     * @return Mend_Model_Builder Provides fluent interface
     */
    public function __call($name, array $arguments)
    {
        assert('substr($name, 0, 4) == "with"');
        $property = lcfirst(substr($name, 4));
        $value = shift($arguments);
        $this->_data[$property] = $value;
        return $this;
    }

    /**
     * Create Object
     */
    abstract public function build();

    /**
     * Disable Magic Accessor
     */
    public function __get($name)
    {
        throw new LogicException('Properties of '.__CLASS__.' cannot be accessed directly.');
    }

    /**
     * Disable Magic Mutator
     */
    public function __set($name, $value)
    {
        throw new LogicException('Properties of '.__CLASS__.' cannot be mutated directly.');
    }
}