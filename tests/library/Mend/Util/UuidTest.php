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
 * UUID Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Util_UuidTest extends PHPUnit_Framework_TestCase
{
	/**
	 * UUID v3
	 *
	 * @return null
	 */
	public function testCanCreateAVersion3Uuid()
	{
	    $this->assertTrue(
	        Mend_Util_Uuid::isValid(
	            Mend_Util_Uuid::v3(
	                Mend_Util_Uuid::v4(),
	                'test'
	            )
	        )
	    );
	}

	/**
	 * UUID v4
	 *
	 * @return null
	 */
	public function testCanCreateAVersion4Uuid()
	{
	    $this->assertTrue(
	        Mend_Util_Uuid::isValid(
                Mend_Util_Uuid::v4()
	        )
	    );
	}

	/**
	 * UUID v5
	 *
	 * @return null
	 */
	public function testCanCreateAVersion5Uuid()
	{
	    $this->assertTrue(
	        Mend_Util_Uuid::isValid(
                Mend_Util_Uuid::v5(
	                Mend_Util_Uuid::v4(),
	                'test'
	            )
	        )
	    );
	}
}