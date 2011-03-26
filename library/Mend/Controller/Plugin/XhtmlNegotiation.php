<?php
/**
 * Zend_Mend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 *
 * @category   Zend_Mend
 * @package    Controller
 * @subpackage Plugin
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 */

/**
 * XHTML Content-Negotiation Controller Plugin
 *
 * @author Richard Knop <risoknop@gmail.com>
 * @author Doug Hurst <doug@echoeastcreative.com>
 * @link http://blog.richardknop.com/2010/07/zend-framework-content-negotiation-plugin/
 * @link http://framework.zend.com/manual/en/zend.controller.plugins.html
 */
class Mend_Controller_Plugin_XhtmlNegotiation extends Zend_Controller_Plugin_Abstract
{
    /**
     * Pre-Dispatch Action
     *
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     * @param Zend_Controller_Request_Abstract $request The request object
     * @return void
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