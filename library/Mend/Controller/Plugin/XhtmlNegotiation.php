<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Controller
 * @subpackage Plugins
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * XHTML Content-Negotiation Controller Plugin
 *
 * @category   Zend_Mend
 * @package    Controller
 * @subpackage Plugins
 * @author     Richard Knop <risoknop@gmail.com>
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://blog.richardknop.com/2010/07/zend-framework-content-negotiation-plugin/
 * @link       http://framework.zend.com/manual/en/zend.controller.plugins.html
 */
class Mend_Controller_Plugin_XhtmlNegotiation extends Zend_Controller_Plugin_Abstract
{
    /**
     * Pre-Dispatch Action
     *
     * @param Zend_Controller_Request_Abstract $request The request object
     *
     * @return void
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // Set Response correctly if possible
        if ($this->getResponse()->canSendHeaders()) {
            if (stristr($request->getHeader('Accept'), 'application/xhtml+xml') !== false
                || stristr($request->getHeader('Accept'), 'application/xml') !== false
            ) {
                $this->getResponse()->setHeader('Content-Type', 'application/xhtml+xml; charset=utf-8');
                $this->getResponse()->setHeader('Vary', 'Accept');
            }
        }
    }
}