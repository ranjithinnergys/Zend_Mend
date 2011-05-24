<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Log
 * @package   Writer
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Atom Publishing Protocol Log Writer
 *
 * @category  Log
 * @package   Writer
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://www.ietf.org/rfc/rfc5023.txt
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Log_Writer_Atom extends Zend_Log_Writer_Abstract
{
    /** @var Zend_Http_Client */
    private $_client;

    /**
     * Constructor
     *
     * @param string|Zend_Uri_Http $uri URI for the Atom service
     *
     * @return void
     */
    public function __construct($uri)
    {
        $this->_createClient($uri);
    }

    /**
     * Write a message to the log.
     *
     * @param array $event log data event
     *
     * @return void
     */
    protected function _write($event)
    {
        $entry = $this->_createEntry($event);
        $response = $this->_client
            ->setRawData($entry)
            ->request();
    }

    /**
     * Create an Atom <entry/> DOM Document
     *
     * @param array $event log data event
     *
     * @return string The serialized XML
     */
    private function _createEntry($event)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $entry = $dom->createElementNS('http://www.w3.org/2005/Atom', 'entry');

        //  <content />
        $content = $dom->createElementNS('http://www.w3.org/2005/Atom', 'content');
        $content->appendChild($dom->createTextNode($event['message']));
        if (isset($event['content_type'])) {
            $content->setAttributeNS('http://www.w3.org/2005/Atom', 'type', $event['content_type']);
        }
        $entry->appendChild($content);

        //  <id />
        $id = $dom->createElementNS('http://www.w3.org/2005/Atom', 'id');
        $id->appendChild($dom->createTextNode('urn:uuid:'.$this->_uuid()));
        $entry->appendChild($id);

        //  <title />
        $title = $dom->createElementNS('http://www.w3.org/2005/Atom', 'title');
        $title->appendChild(
            $dom->createTextNode(isset($event['title']) ? $event['title'] : $event['priorityName'])
        );
        $entry->appendChild($title);

        //  <update />
        $update = $dom->createElementNS('http://www.w3.org/2005/Atom', 'update');
        $update->appendChild($dom->createTextNode($event['timestamp']));
        $entry->appendChild($update);

        $dom->appendChild($entry);
        return $dom->saveXML();
    }

    /**
     * Create an HTTP Client
     *
     * @param string|Zend_Uri_Http $uri URI for the Atom service
     *
     * @return void
     */
    private function _createClient($uri)
    {
        $client = new Zend_Http_Client($uri);
        $client
            ->setHeaders('Content-Type', 'application/atom+xml')
            ->setMethod(Zend_Http_Client::POST);
        $this->_client = $client;
    }

    /**
     * Generate a RFC-4122 v4 UUID
     *
     * @return string
     * @link http://www.php.net/manual/en/function.uniqid.php#94959
     * @link http://tools.ietf.org/html/rfc4122
     */
    private function _uuid()
    {
        return sprintf(
        	'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Create a new instance of Mend_Log_Writer_Atom
     *
     * @param array|Zend_Config $config Configuration for the object
     *
     * @return Mend_Log_Writer_Atom
     */
    static public function factory($config)
    {
        $config = self::_parseConfig($config);
        $config = array_merge(array('uri' => null), $config);
        return new self($config['uri']);
    }
}
