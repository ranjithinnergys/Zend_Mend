<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Services
 * @subpackage Geocoder
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Address Geocoder Adapter: Google API
 *
 * @category   Zend_Mend
 * @package    Services
 * @subpackage Geocoder
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 * @link       http://code.google.com/apis/maps/documentation/geocoding/
 */
class Mend_Service_Geocoder_Adapter_Google
implements Mend_Service_Geocoder_Adapter_Interface
{
    /**
     * @staticvar string The URI for Google's Geocoding Service
     */
    const URI = 'http://maps.googleapis.com/maps/api/geocode/json';

    /**
     * Geocode an Address
     *
     * @param Zend_Http_Client       $client  The HTTP Client
     * @param Mend_Model_DTO_Address $address The Address
     * @param array                  $options Options for this adapter
     *
     * @return Mend_Model_DTO_Geolocation
     */
    public function geocode(
        Zend_Http_Client $client,
        Mend_Model_DTO_Address $address,
        array $options
    )
    {
        //  Indicates whether or not the geocoding request comes from a device
        //  with a location sensor. This value must be either true or false.
        if (!isset($options['sensor']) || !is_bool($options['sensor'])) {
            $options['sensor'] = false;
        }

        //  Serialize Address DTO
        $serialized = implode(',', $address->street)
            .','.$address->city
            .','.(is_null($address->state) ? $address->province : $address->state);
        if (!empty($address->country)) {
            $serialized .= ','.$address->country;
        }

        $client
            ->setUri(self::URI)
            ->setMethod(Zend_Http_Client::GET)
            ->setParameterGet('address', $serialized)
            ->setParameterGet('sensor', $options['sensor'] ? 'true' : 'false');

        $data = json_decode($client->request()->getBody(), true);
        $geolocation = new Mend_Model_DTO_Geolocation();
        if ($data['status'] == 'OK') {
            $location = $data['results'][0]['geometry']['location'];
            $geolocation->latitude = (double) $location['lat'];
            $geolocation->longitude = (double) $location['lng'];
        }
        return $geolocation;
    }
}