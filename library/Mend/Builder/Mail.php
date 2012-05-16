<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Builder
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Builder: Mail DTO
 *
 * @category  Zend_Mend
 * @package   Builder
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Builder_Mail
{
    /**
     * @var Mend_Model_DTO_Mail The DTO
     */
    private $_dto;

    /**
     * @var Zend_Validate_EmailAddress Email Validator
     */
    private $_validator;

    /**
     * Private Constructor
     */
    private function __construct()
    {
        $this->_dto = new Mend_Model_DTO_Mail();
        $this->_validator = new Zend_Validate_EmailAddress();
    }

    /**
     * Fluent Constructor
     *
     * @return Mend_Builder_Mail
     */
    public static function start()
    {
        return new self;
    }

    /**
     * Finalizer
     *
     * @return Mend_Model_DTO_Mail
     */
    public function build()
    {
        return $this->_dto;
    }

    /**
     * Clear "BCC" Addresses
     *
     * @return Mend_Builder_Mail
     */
    public function clearBccAddresses()
    {
        $this->_dto->addressesBcc = array();
        return $this;
    }

    /**
     * Clear "CC" Addresses
     *
     * @return Mend_Builder_Mail
     */
    public function clearCcAddresses()
    {
        $this->_dto->addressesCc = array();
        return $this;
    }

    /**
     * Clear "To" Addresses
     *
     * @return Mend_Builder_Mail
     */
    public function clearToAddresses()
    {
        $this->_dto->addressesTo = array();
        return $this;
    }

    /**
     * Add a "BCC" Address
     *
     * @param string $address The Address
     *
     * @return Mend_Builder_Mail
     */
    public function withBccAddress($address)
    {
        assert('$this->isEmail($address)');
        $this->_dto->addressesBcc[] = $address;
        return $this;
    }

    /**
     * Add a "CC" Address
     *
     * @param string $address The Address
     *
     * @return Mend_Builder_Mail
     */
    public function withCcAddress($address)
    {
        assert('$this->isEmail($address)');
        $this->_dto->addressesCc[] = $address;
        return $this;
    }

    /**
     * Add a "To" Address
     *
     * @param string $address The Address
     *
     * @return Mend_Builder_Mail
     */
    public function withToAddress($address)
    {
        assert('$this->isEmail($address)');
        $this->_dto->addressesTo[] = $address;
        return $this;
    }

    /**
     * "From" Address Mutator
     *
     * @param string $address The Address
     *
     * @return Mend_Builder_Mail
     */
    public function withFromAddress($address)
    {
        assert('$this->isEmail($address)');
        $this->_dto->addressFrom = $address;
        return $this;
    }

    /**
     * "Reply-To" Address Mutator
     *
     * @param string $address The Address
     *
     * @return Mend_Builder_Mail
     */
    public function withReplyToAddress($address)
    {
        assert('$this->isEmail($address)');
        $this->_dto->addressReplyTo = $address;
        return $this;
    }

    /**
     * Subject Mutator
     *
     * @param string $subject The Subject
     *
     * @return Mend_Builder_Mail
     */
    public function withSubject($subject)
    {
        assert('is_string($subject)');
        $this->_dto->subject = $subject;
        return $this;
    }

    /**
     * HTML Body Mutator
     *
     * @param Zend_View $view     The View
     * @param string    $template The View Template
     *
     * @return Mend_Builder_Mail
     */
    public function withHtmlView(Zend_View $view, $template)
    {
        assert('file_exists($view->getScriptPath($template))');
        $this->_dto->bodyHtml = $view->render($template);
        return $this;
    }

    /**
     * Text Body Mutator
     *
     * @param Zend_View $view     The View
     * @param string    $template The View Template
     *
     * @return Mend_Builder_Mail
     */
    public function withTextView(Zend_View $view, $template)
    {
        assert('file_exists($view->getScriptPath($template))');
        $this->_dto->bodyText = $view->render($template);
        return $this;
    }

    /**
     * Validate an Email
     *
     * @param string $address An Email Address
     *
     * @return bool
     */
    private function isEmail($address)
    {
        return $this->_validator->isValid($address);
    }
}
