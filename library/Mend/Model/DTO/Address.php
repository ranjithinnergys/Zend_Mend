<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Util
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Generic Address Data Transfer Object
 *
 * @category  Zend_Mend
 * @package   Model
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Model_DTO_Address
extends Mend_Model_DTO_Abstract
{
    /**
     * @var array The Street Address (could be multiple lines)
     */
    public $street = array();

    /**
     * @var string The City
     */
    public $city;

    /**
     * @var string The US State (2 character)
     */
    public $state;

    /**
     * @var string The US ZIP Code (5 or 9-digit)
     */
    public $zip;

    /**
     * @var string The Province
     */
    public $province;

    /**
     * @var string The Postal Code
     */
    public $postal;

    /**
     * @var string The Country (2 character)
     */
    public $country;
}