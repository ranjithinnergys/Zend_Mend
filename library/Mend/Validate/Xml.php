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
 * XML Validator
 *
 * Well-formedness check and optional schema validation.
 *
 * @category  Zend_Mend
 * @package   Validators
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Validate_Xml extends Zend_Validate_Abstract
{
    /**
     * @var string The path to an XML Schema document
     */
    private $_xsd;

    /**
     * Constructor
     *
     * @param string $xsd The path to an XML Schema document
     *
     * @return null
     */
    public function __construct($xsd = null)
    {
        if (!is_null($xsd) && file_exists($xsd)) {
            $this->_xsd = $xsd;
        }
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return boolean
     * @throws Zend_Validate_Exception If validation of $value is impossible
     */
    public function isValid($value)
    {
        //  $value could be a DOMDocument
        if ($value instanceof DOMDocument) {
            $doc = $value;
        }

        //  $value could be an XML file or string
        if (is_string($value)) {
            $doc = new DOMDocument();
            if (!file_exists($value)) {
                try {
                    $doc->loadXML($value);
                } catch (Exception $e) {
                    return false;
                }
            } else {
                try {
                    $doc->load($value);
                } catch (Exception $e) {
                    return false;
                }
            }
        }

        if (!is_null($this->_xsd)) {
            try {
                $doc->schemaValidate($this->_xsd);
            } catch (Exception $e) {
                return false;
            }
        }

        return true;
    }
}