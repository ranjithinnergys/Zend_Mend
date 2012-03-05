<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * North American Numbering Plan (NANP) Validator Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Validate_USTelephoneTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Validate_USTelephone';

	public function testCanInstantiateClass()
	{
	    $this->assertInstanceOf($this->_classname, new $this->_classname());
	}

	public function testSevenDigitNumberPasses()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('5551234'));
	}

	public function testSevenDigitNumberPasses2()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('555-1234'));
	}

	public function testSevenDigitNumberPasses3()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('555.1234'));
	}

	public function testTenDigitNumberPasses()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('6155551234'));
	}

	public function testTenDigitNumberPasses2()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('(615) 555-1234'));
	}

	public function testTenDigitNumberPasses3()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('615-555-1234'));
	}

	public function testTenDigitNumberPasses4()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('615.555.1234'));
	}

	public function testElevenDigitNumberPasses()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('16155551234'));
	}

	public function testElevenDigitNumberPasses2()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('+1 (615) 555-1234'));
	}

	public function testElevenDigitNumberPasses3()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('1-615-555-1234'));
	}

	public function testElevenDigitNumberPasses4()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('1.615.555.1234'));
	}

	public function testBadNumbersDoNotPass()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('1'));
	}

	public function testBadNumbersDoNotPass2()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('12'));
	}

	public function testBadNumbersDoNotPass3()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('123'));
	}

	public function testBadNumbersDoNotPass4()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('1234'));
	}

	public function testBadNumbersDoNotPass5()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('12345'));
	}

	public function testBadNumbersDoNotPass6()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('123456'));
	}

	public function testBadNumbersDoNotPass7()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('12345678'));
	}

	public function testBadNumbersDoNotPass8()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('123456789'));
	}

	public function testBadNumbersDoNotPass9()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('123456789012'));
	}
}