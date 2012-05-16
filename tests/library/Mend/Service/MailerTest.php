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
 * Mailer Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Service_MailerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup Mock Mail Service
     */
    public function setUp()
    {
        Zend_Mail::setDefaultTransport(
            new Zend_Mail_Transport_File(
                array(
                    'path' => TESTS_ROOT.'/resources',
                    'callback' => function($transport) {
                        return __CLASS__.'.mail.out';
                    }
                )
            )
        );
    }

	/**
	 * Send mail with the builder
	 *
	 * @return null
	 */
	public function testCanSendAMailDto()
	{
        $view = new Zend_View();
        $view->setBasePath(TESTS_ROOT.'/resources/views');
        $view->hello = "Hello, World";

	    $dto = Mend_Builder_Mail::start()
            ->withFromAddress('from@example.com')
            ->withToAddress('to@example.com')
            ->withSubject('Test Mail Object')
            ->withHtmlView($view, 'html.phtml')
            ->withTextView($view, 'text.phtml')
            ->build();
        Mend_Service_Mailer::getInstance()->send($dto);

        $mail = file_get_contents(TESTS_ROOT.'/resources/'.__CLASS__.'.mail.out');
        $this->assertEquals(1, preg_match('/\r?From: from@example.com\r/', $mail));
        $this->assertEquals(1, preg_match('/\r?To: to@example.com\r/', $mail));
        $this->assertEquals(1, preg_match('/\r?Subject: Test Mail Object\r/', $mail));
        $this->assertEquals(2, preg_match_all('/'.$view->hello.'/', $mail, $ignore));
	}
}
