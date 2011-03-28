<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Controllers
 * @subpackage Plugins
 * @author     Doug Hurst <doug@echoeastcreative.com>
 * @copyright  2011 Echo East Creative, LLC
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       https://github.com/echoeastcreative/Zend_Mend
 */

/**
 * XHTML Content-Negotiation Controller Plugin
 *
 * @category   Zend_Mend
 * @package    Controllers
 * @subpackage Plugins
 * @author     Richard Knop <risoknop@gmail.com>
 * @author     Doug Hurst <doug@echoeastcreative.com>
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
        /** Get view */
        $viewRenderer = Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer');
        $viewRenderer->initView();
        $view = $viewRenderer->view;

        /** Set Response & Doctype correctly */
        if ($this->getResponse()->canSendHeaders()) {
            $this->getResponse()->setHeader('Vary', 'Accept');
            if (stristr($request->getHeader('Accept'), 'application/xhtml+xml') === false) {
                $this->getResponse()->setHeader('Content-Type', 'text/html; charset=utf-8');
                $view->doctype('HTML5');
            } else {
                $this->getResponse()->setHeader('Content-Type', 'application/xhtml+xml; charset=utf-8');
                $view->doctype('XHTML5');
            }
        }
    }
}