<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Service
 * @subpackage Geocoder
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Address Geocoder Adapter Interface
 *
 * @category   Zend_Mend
 * @package    Service
 * @subpackage Geocoder
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 * @link       http://code.google.com/apis/maps/documentation/geocoding/
 */
interface Mend_Service_Geocoder_Adapter_Interface
{
    /**
     * Geocode an Address
     *
     * @param Mend_Model_DTO_Address $address The Address
     * @param array                  $options Options for this adapter
     *
     * @return Mend_Model_DTO_Geolocation
     */
    public function geocode(
        Zend_Http_Client $client,
        Mend_Model_DTO_Address $address,
        array $options
    );
}