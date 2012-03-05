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
 * URL Validator Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Validate_UrlTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Validate_Url';

	public function testAcceptOnlyValidUrls()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('http://example.com'));
	}

	public function testAcceptOnlyValidUrls2()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('http://example.com/'));
	}

	public function testAcceptOnlyValidUrls3()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('not even close'));
	}

	public function testAcceptOnlyValidUrls4()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('javascript:alert("yep");'));
	}
}