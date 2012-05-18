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
	public function testCanBuildAZendMailObject()
	{
        $view = new Zend_View();
        $view->hello = "Hello World";
        $view->setBasePath(TESTS_ROOT.'/resources/views');
	    $mail = Mend_Builder_Mail::start()
            ->withFromAddress('from@example.com')
            ->withToAddress('to@example.com')
            ->withSubject('Test Mail Object')
            ->withHtmlView($view, 'html')
            ->withTextView($view, 'text')
            ->build();
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('from@example.com', $mail->getFrom());
        $this->assertEquals(array('to@example.com'), $mail->getRecipients());
        $this->assertEquals('Test Mail Object', $mail->getSubject());
        $this->assertContains('<p>Hello World</p>', $mail->getBodyHtml(true));
        $this->assertContains('Hello World', $mail->getBodyText(true));
	}

    /**
     * Create a Mail DTO with the builder
     *
     * @return null
     */
    public function testCanBuildAZendMailObject2()
    {
        $layoutHtml = new Zend_Layout(TESTS_ROOT.'/resources/layouts');
        $layoutText = new Zend_Layout(TESTS_ROOT.'/resources/layouts');
        $view = new Zend_View();
        $view->hello = "Hello World";
        $view->setBasePath(TESTS_ROOT.'/resources/views');
        $mail = Mend_Builder_Mail::start()
            ->withFromAddress('from@example.com', 'From Guy')
            ->withToAddress('to@example.com', 'To Guy')
            ->withSubject('Test Mail Object')
            ->withHtmlLayout($layoutHtml, 'html')
            ->withTextLayout($layoutText, 'text')
            ->withHtmlView($view, 'html')
            ->withTextView($view, 'text')
            ->build();
        $this->assertInstanceOf('Zend_Mail', $mail);
        $this->assertEquals('from@example.com', $mail->getFrom());
        $this->assertEquals(array('to@example.com'), $mail->getRecipients());
        $this->assertEquals('Test Mail Object', $mail->getSubject());
        $this->assertContains('<p>Hello World</p>', $mail->getBodyHtml(true));
        $this->assertContains('Hello World', $mail->getBodyText(true));
    }
}
