<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Service
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Mailer Wrapper
 *
 * @category  Zend_Mend
 * @package   Service
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Service_Mailer
{
    /**
     * @var Mend_Service_Mailer Singleton Instance
     */
    private static $_instance;

    /**
     * @var Zend_Mail The Mailer
     */
    private $_mailer;

    /**
     * Private Constructor
     */
    private function __construct()
    {
        $this->_mailer = new Zend_Mail();
    }

    /**
     * Singleton Accessor
     *
     * @return Mend_Service_Mailer
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Send an Email
     *
     * @param Mend_Model_DTO_Mail $dto The email object
     *
     * @return null
     */
    public function send(Mend_Model_DTO_Mail $dto)
    {
        //  Reset properties
        foreach ($this->_mailer->getHeaders() as $header => $value) {
            $this->_mailer->clearHeader($header);
        }

        //  Allow overriding any default "From" address
        if (!is_null($dto->addressFrom)) {
            $this->_mailer->setFrom($dto->addressFrom);
        }

        //  Allow overriding any default "Reply-To" address
        if (!is_null($dto->addressReplyTo)) {
            $this->_mailer->setReplyTo($dto->addressReplyTo);
        }

        //  Send Mail
        $this->_mailer
            ->addTo($dto->addressesTo)
            ->addCc($dto->addressesCc)
            ->addBcc($dto->addressesBcc)
            ->setSubject($dto->subject)
            ->setBodyHtml($dto->bodyHtml)
            ->setBodyText($dto->bodyText)
            ->send();
    }
}
