<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Immutable Object Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Model_ImmutableTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Model_Immutable';

	public function testCanInstantiateClass()
	{
	    $this->assertInstanceOf($this->_classname, new $this->_classname(array()));
	}

	public function testExistingPropertiesAreImmutable()
	{
	    $this->setExpectedException('LogicException');
	    $data = array('key' => 'value');
	    $immutable = new $this->_classname($data);
	    $immutable->key = 'new value';
	}

	public function testExistingPropertiesAreImmutable2()
	{
	    $this->setExpectedException('LogicException');
	    $data = array('key' => 'value');
	    $immutable = new $this->_classname($data);
	    unset($immutable->key);
	}

	public function testNewPropertiesCannotBeCreated()
	{
	    $this->setExpectedException('LogicException');
	    $data = array('key' => 'value');
	    $immutable = new $this->_classname($data);
	    $immutable->newKey = 'value';
	}
}