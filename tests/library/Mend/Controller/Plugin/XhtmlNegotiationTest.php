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
 * XHTML Negotiation Controller Plugin Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Controller_Plugin_XhtmlNegotiationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        Zend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::addHelper(new Zend_Controller_Action_Helper_ViewRenderer());
    }

	/**
	 * Class Instantiation Test
	 *
	 * @return void
	 */
    public function testCanInstantiateClass()
    {
        $plugin = new Mend_Controller_Plugin_XhtmlNegotiation();
        $this->assertInstanceOf('Mend_Controller_Plugin_XhtmlNegotiation', $plugin);
        $this->assertInstanceOf('Zend_Controller_Plugin_Abstract', $plugin);
    }

	/**
	 * Can respond with XHTML MIME-type if acceptable
	 *
	 * @return void
	 */
    public function testCanRespondWithXhtml()
    {
        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setHeader('Accept', 'application/xhtml+xml', true);
        $response = new Zend_Controller_Response_HttpTestCase();
        $plugin = new Mend_Controller_Plugin_XhtmlNegotiation();
        $plugin->setResponse($response);
        $plugin->preDispatch($request);

        list($content_type, $vary) = $response->getHeaders();
        $this->assertEquals('Content-Type', $content_type['name']);
        $this->assertEquals('application/xhtml+xml; charset=utf-8', $content_type['value']);
        $this->assertEquals('Vary', $vary['name']);
        $this->assertEquals('Accept', $vary['value']);
    }

	/**
	 * Can respond with HTML MIME-type if acceptable
	 *
	 * @return void
	 */
    public function testCanRespondWithHtml()
    {
        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setHeader('Accept', 'text/html', true);
        $response = new Zend_Controller_Response_HttpTestCase();
        $plugin = new Mend_Controller_Plugin_XhtmlNegotiation();
        $plugin->setResponse($response);
        $plugin->preDispatch($request);

        list($content_type, $vary) = $response->getHeaders();
        $this->assertEquals('Content-Type', $content_type['name']);
        $this->assertEquals('text/html; charset=utf-8', $content_type['value']);
        $this->assertEquals('Vary', $vary['name']);
        $this->assertEquals('Accept', $vary['value']);
    }

	/**
	 * Does not disrupt other MIME-types
	 *
	 * @return void
	 */
    public function testDoesNotDispruptOtherMimeTypes()
    {
        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setHeader('Accept', 'application/json', true);
        $response = new Zend_Controller_Response_HttpTestCase();
        $plugin = new Mend_Controller_Plugin_XhtmlNegotiation();
        $plugin->setResponse($response);
        $plugin->preDispatch($request);

        $this->assertEmpty($response->getHeaders());
    }
}
