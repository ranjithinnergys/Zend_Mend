<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Services
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Address Geocoder
 *
 * @category  Zend_Mend
 * @package   Services
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 * @link      http://code.google.com/apis/maps/documentation/geocoding/
 */
class Mend_Service_Geocoder
extends Zend_Service_Abstract
{
    /**
     * @var string The URI for Google's Geocoding Service
     */
    private static $_uri = 'http://maps.googleapis.com/maps/api/geocode/json';

    /**
     * Geocode a US Address
     *
     * @param string $street   The Street Address (no Apt, Ste, etc. lines)
     * @param string $city     The City
     * @param string $state    The US State
     * @param bool   $isSensor Is this geocoding request from a device with a location sensor?
     *
     * @return array (Latitude, Longitude)
     */
    public static function geocodeUSAddress($street, $city, $state, $isSensor = false)
    {
        $client = self::getHttpClient();
        $response = $client
            ->setUri(self::$_uri)
            ->setMethod(Zend_Http_Client::GET)
            ->setParameterGet('address', $street.','.$city.','.$state)
            ->setParameterGet('sensor', $isSensor ? 'true' : 'false')
            ->request();

        $data = json_decode($response->getBody(), true);
        if ($data['status'] == 'OK') {
            return array(
                $data['results'][0]['geometry']['location']['lat'],
                $data['results'][0]['geometry']['location']['lng']
            );
        } else {
            return array(0,0);
        }
    }
}