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
 * Atom Publishing Protocol Log Writer Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Log_Writer_AtomTest extends PHPUnit_Framework_TestCase
{
    private $_classname = 'Mend_Log_Writer_Atom';
    private $_uri = 'http://localhost:8080/exist/atom/edit/Mend_Log_Writer_AtomTest';

    /**
     * Set Up
     *
     * @return void
     */
    protected function setUp()
    {
        $client = new Zend_Http_Client($this->_uri);
        $client
            ->setHeaders('Content-Type', 'application/atom+xml')
            ->setMethod(Zend_Http_Client::POST)
            ->setRawData(
                '<?xml version="1.0" ?>'.
                '<feed xmlns="http://www.w3.org/2005/Atom">'.
                '<title>All Users</title>'.
                '</feed>'
            )
            ->request();
    }

	/**
	 * Class Instantiation Test
	 *
	 * @return void
	 */
	public function testCanInstantiateClass()
	{
	    $this->assertInstanceOf($this->_classname, new $this->_classname($this->_uri));
	}

	/**
	 * Can log entry
	 *
	 * @return void
	 */
	public function testCanLogEntry()
	{
	    $logger = new Zend_Log();
	    $logger->addWriter(new $this->_classname($this->_uri));
	    $logger->log('Test', $logger::INFO);
	}
}