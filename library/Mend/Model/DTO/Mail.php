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
 * @copyright  2012 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Mail Data Transfer Object
 *
 * @category   Zend_Mend
 * @package    Model
 * @subpackage DTO
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2012 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Model_DTO_Mail
extends Mend_Model_DTO_Abstract
{
    /**
     * @var string "From " Address
     */
    public $addressFrom;

    /**
     * @var string "Reply-To " Address
     */
    public $addressReplyTo;

    /**
     * @var array "To" Addresses
     */
    public $addressesTo = array();

    /**
     * @var array "CC" Addresses
     */
    public $addressesCc = array();

    /**
     * @var array "BCC" Addresses
     */
    public $addressesBcc = array();

    /**
     * @var string Subject
     */
    public $subject;

    /**
     * @var string text/html Body
     */
    public $bodyHtml;

    /**
     * @var string text/plain Body
     */
    public $bodyText;
}
