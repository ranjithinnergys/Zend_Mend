<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage DTO
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Geolocation Data Transfer Object
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage DTO
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Model_DTO_Geolocation
extends Mend_Model_DTO_Abstract
{
    /**
     * @var float The Latitude
     */
    public $latitude = 0.0;

    /**
     * @var float The Longitude
     */
    public $longitude = 0.0;
}