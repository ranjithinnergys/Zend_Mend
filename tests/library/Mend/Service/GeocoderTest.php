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
 * Address Geocoder Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Service_GeocoderTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Singleton Construction
	 *
	 * @return null
	 */
	public function testIsASingleton()
	{
	    $reflector = new ReflectionClass('Mend_Service_Geocoder');
	    $this->assertTrue($reflector->getConstructor()->isPrivate());
	}

	/**
	 * Singleton Construction
	 *
	 * @return null
	 */
	public function testIsASingleton2()
	{
	    $this->assertInstanceOf(
	    	'Mend_Service_Geocoder',
	        Mend_Service_Geocoder::getInstance()
	    );
	}

	/**
	 * Get Default Adapter
	 *
	 * @return null
	 */
	public function testCanGetDefaultAdpater()
	{
	    $this->assertInstanceOf(
	    	'Mend_Service_Geocoder_Adapter_Interface',
	        Mend_Service_Geocoder::getInstance()->getDefaultAdapter()
	    );
	}

	/**
	 * US Address Geocoding
	 *
	 * @return null
	 */
	public function testGeocodingAnAddressReturnsGeolocation()
	{
	    $address = new Mend_Model_DTO_Address();
	    $address->street = array('1600 Pennsylvania Ave');
	    $address->city = 'Washington';
	    $address->state = 'DC';
	    $geolocation = Mend_Service_Geocoder::getInstance()->geocode($address);
	    $this->assertInstanceOf('Mend_Model_DTO_Geolocation', $geolocation);
	    $this->assertGreaterThan(38.897, $geolocation->latitude);
	    $this->assertLessThan(-77.036, $geolocation->longitude);
	}
}
