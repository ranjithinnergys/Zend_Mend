<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Mail Builder Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Builder_MailTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Create a Mail DTO with the builder
	 *
	 * @return null
	 */
	public function testCanCreateAMailDto()
	{
        $view = new Zend_View();
        $view->setBasePath(TESTS_ROOT.'/resources/views');
	    $dto = Mend_Builder_Mail::start()
            ->withFromAddress('from@example.com')
            ->withToAddress('to@example.com')
            ->withSubject('Test Mail Object')
            ->withHtmlView($view, 'html.phtml')
            ->withTextView($view, 'text.phtml')
            ->build();
        $this->assertInstanceOf('Mend_Model_DTO_Mail', $dto);
        $this->assertInternalType('array', $dto->addressesBcc);
        $this->assertInternalType('array', $dto->addressesCc);
        $this->assertInternalType('array', $dto->addressesTo);
        $this->assertInternalType('string', $dto->subject);
        $this->assertInternalType('string', $dto->bodyHtml);
        $this->assertInternalType('string', $dto->bodyText);
        $this->assertEquals(0, count($dto->addressesBcc));
        $this->assertEquals(0, count($dto->addressesCc));
        $this->assertEquals(1, count($dto->addressesTo));
	}
}
