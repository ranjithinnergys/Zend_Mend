<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * XML Validator Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Validate_XmlTest extends PHPUnit_Framework_TestCase
{
    const TXT = '/../../../resources/Mend_Validate_XmlTest.txt';
    const XML = '/../../../resources/Mend_Validate_XmlTest.xml';
    const XSD = '/../../../resources/Mend_Validate_XmlTest.xsd';
    private $_classname = 'Mend_Validate_Xml';

	public function testAcceptsAValidXmlString()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid('<xml></xml>'));
	}

	public function testAcceptsAValidXmlString2()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid('xml?'));
	}

	public function testAcceptsADomdocument()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid(new DOMDocument('1.0', 'utf-8')));
	}

	public function testAcceptsAnXmlFile()
	{
	    $validator = new $this->_classname();
	    $this->assertTrue($validator->isValid(__DIR__.self::XML));
	}

	public function testAcceptsAnXmlFile2()
	{
	    $validator = new $this->_classname();
	    $this->assertFalse($validator->isValid(__DIR__.self::TXT));
	}

	public function testCanValidateWithXmlSchema()
	{
	    $validator = new $this->_classname(__DIR__.self::XSD);
	    $this->assertTrue($validator->isValid(__DIR__.self::XML));
	}

	public function testCanValidateWithXmlSchema2()
	{
	    $validator = new $this->_classname(__DIR__.self::XSD);
	    $this->assertFalse($validator->isValid('<xml></xml>'));
	}
}