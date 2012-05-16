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
 * Address Geocoder Adapter: Google API
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
        $geolocation = new Mend_Model_DTO_Geolocation();
        $data = json_decode(
            $client
                ->setEncType($client::ENC_FORMDATA)
                ->setUri(self::URI)
                ->setMethod(Zend_Http_Client::GET)
                ->setParameterGet(
                    'address',
                    implode(',', $address->street)
                        .','.$address->city
                        .','.(is_null($address->state)
                            ? $address->province
                            : $address->state)
                        .(!empty($address->country) ? ','.$address->country : ''))
                ->setParameterGet(
                    'sensor',
                    (!isset($options['sensor']) || !is_bool($options['sensor']) || !$options['sensor'])
                        ? 'false'
                        : 'true')
                ->request()
                ->getBody(),
            true
        );

        if ($data['status'] == 'OK') {
            $geolocation->latitude = (double) $data['results'][0]['geometry']['location']['lat'];
            $geolocation->longitude = (double) $data['results'][0]['geometry']['location']['lng'];
        }

        return $geolocation;
    }
}
