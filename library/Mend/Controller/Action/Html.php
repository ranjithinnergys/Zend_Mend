<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Controller
 * @subpackage Actions
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * (X)HTML Action Controller
 *
 * @category   Zend_Mend
 * @package    Controller
 * @subpackage Actions
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Controller_Action_Html extends Zend_Controller_Action
{
    /**
     * Constructor
     *
     * Overriding to
     *  * Parameterize PUT & DELETE requests
     *  * Initialize some view helpers
     *  * Set the IS_XHR definition
     *
     * @param Zend_Controller_Request_Abstract  $request    The request
     * @param Zend_Controller_Response_Abstract $response   The response
     * @param array                             $invokeArgs Any additional invocation arguments
     *
     * @return void
     */
    public function __construct(
        Zend_Controller_Request_Abstract $request,
        Zend_Controller_Response_Abstract $response,
        array $invokeArgs = array()
    )
    {
        parent::__construct($request, $response, $invokeArgs);

        // Parameterize DELETE and PUT Requests
        if ($this->getRequest()->isDelete() || $this->getRequest()->isPut()) {
            parse_str($this->getRequest()->getRawBody(), $params);
            foreach ($params as $key => $value) {
                $this->getRequest()->setParam($key, $value);
            }
        }

        $this->view->doctype('XHTML5');
        $this->initJQueryViewHelper();
        $this->initMendViewHelper();

        // Define XMLHttpRequest
        defined('IS_XHR')
            || define(
                'IS_XHR',
                (
                    ($request->getHeader('X-Requested-With') == 'XMLHttpRequest')
                    ? 1
                    : 0
                )
            );
    }

    /**
     * Initialize jQuery View Helpers
     *
     * @return void
     *
     * @link http://jquery.com/
     * @link http://code.google.com/apis/libraries/devguide.html
     */
    protected function initJQueryViewHelper()
    {
        $view = $this->view;
        $view->addHelperPath(
            'ZendX/JQuery/View/Helper',
            'ZendX_JQuery_View_Helper'
        );
        $view->jQuery()->enable();
    }

    /**
     * Initialize Mend View Helpers
     *
     * @return void
     *
     * @link http://github.com/dalanhurst/Zend_Mend
     */
    protected function initMendViewHelper()
    {
        $view = $this->view;
        $view->addHelperPath(
            'Mend/View/Helper',
            'Mend_View_Helper'
        );
    }
}