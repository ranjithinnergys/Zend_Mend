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
 * Currency Validator Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Validate_CurrencyTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Validate_Currency';

	public function testAcceptOnlyValidDollarAmounts()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('1.00'));
	}

	public function testAcceptOnlyValidDollarAmounts2()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('A dollar'));
	}
}