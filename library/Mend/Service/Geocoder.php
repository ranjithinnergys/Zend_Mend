<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Service
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Address Geocoder
 *
 * @category  Zend_Mend
 * @package   Service
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Service_Geocoder
extends Zend_Service_Abstract
{
    /**
     * @var Mend_Service_Geocoder_Adapter_Interface The Geocoding Adapter
     */
    private static $_defaultAdapter = null;

    /**
     * @var Mend_Service_Geocoder The Geocoding Service
     */
    private static $_instance = null;

    /**
     * Singleton Constructor
     */
    final private function __construct()
    {
    }

    /**
     * Get Default Geocoding Adapter
     *
     * @return Mend_Service_Geocoder_Adapter_Interface
     */
    public static function getDefaultAdapter()
    {
        if (is_null(self::$_defaultAdapter)) {
            self::$_defaultAdapter = new Mend_Service_Geocoder_Adapter_Google();
        }
        return self::$_defaultAdapter;
    }

    /**
     * Get Singleton Instance
     *
     * @return Mend_Service_Geocoder
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Mend_Service_Geocoder();
        }
        return self::$_instance;
    }

    /**
     * Geocode an Address
     *
     * @param Mend_Model_DTO_Address $address The Address
     * @param array|null             $options Options for this adapter
     *
     * @return Mend_Model_DTO_Geolocation
     */
    public function geocode(
        Mend_Model_DTO_Address $address,
        array $options = array()
    )
    {
        return self::getDefaultAdapter()->geocode(self::getHttpClient(), $address, $options);
    }
}
