<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Builder
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Fluent Builder for Zend_Mail
 *
 * @category  Zend_Mend
 * @package   Builder
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2012 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Builder_Mail
{
    /**
     * @var Zend_Validate_EmailAddress Email Validator
     */
    private $_validator;

    /**
     * @var array The Addresses
     */
    private $_addresses;

    /**
     * @var string The Subject
     */
    private $_subject;

    /**
     * @var Zend_Layout The HTML Layout
     */
    private $_layoutHtml;

    /**
     * @var Zend_Layout The Text Layout
     */
    private $_layoutText;

    /**
     * @var Zend_View The HTML View
     */
    private $_viewHtml;

    /**
     * @var string The HTML View Template
     */
    private $_viewHtmlTemplate;

    /**
     * @var Zend_View The Text View
     */
    private $_viewText;

    /**
     * @var string The Text View Template
     */
    private $_viewTextTemplate;

    /**
     * Private Constructor
     */
    private function __construct()
    {
        $this->_validator = new Zend_Validate_EmailAddress();
        $this->_addresses = array(
            'from' => array(),
            'to' => array(),
            'cc' => array(),
            'bcc' => array(),
            'reply-to' => array()
        );
    }

    /**
     * Fluent Constructor
     *
     * @return Mend_Builder_Mail
     */
    public static function start()
    {
        return new self;
    }

    /**
     * Finalizer
     *
     * @return Zend_Mail
     */
    public function build()
    {
        $mail = new Zend_Mail();
        if (count($this->_addresses['from'])) {
            $mail->setFrom(
                current($this->_addresses['from']),
                key($this->_addresses['from'])
            );
        }
        if (count($this->_addresses['reply-to'])) {
            $mail->setReplyTo(
                current($this->_addresses['reply-to']),
                key($this->_addresses['reply-to'])
            );
        }
        if (count($this->_addresses['to'])) {
            $mail->addTo($this->_addresses['to']);
        }
        if (count($this->_addresses['cc'])) {
            $mail->addTo($this->_addresses['cc']);
        }
        if (count($this->_addresses['bcc'])) {
            $mail->addTo($this->_addresses['bcc']);
        }
        if (!is_null($this->_layoutHtml)) {
            $this->_layoutHtml->content = $this->_viewHtml->render($this->_viewHtmlTemplate.'.phtml');
            $mail->setBodyHtml($this->_layoutHtml->render());
        } else {
            $mail->setBodyHtml($this->_viewHtml->render($this->_viewHtmlTemplate.'.phtml'));
        }
        if (!is_null($this->_layoutText)) {
            $this->_layoutText->content = $this->_viewText->render($this->_viewTextTemplate.'.phtml');
            $mail->setBodyText($this->_layoutText->render());
        } else {
            $mail->setBodyText($this->_viewText->render($this->_viewTextTemplate.'.phtml'));
        }
        $mail->setSubject($this->_subject);
        return $mail;
    }

    /**
     * Clear "BCC" Addresses
     *
     * @return Mend_Builder_Mail
     */
    public function clearBccAddresses()
    {
        if (isset($this->_addresses['bcc'])) {
            $this->_addresses['bcc'] = array();
        }
        return $this;
    }

    /**
     * Clear "CC" Addresses
     *
     * @return Mend_Builder_Mail
     */
    public function clearCcAddresses()
    {
        if (isset($this->_addresses['cc'])) {
            $this->_addresses['cc'] = array();
        }
        return $this;
    }

    /**
     * Clear "To" Addresses
     *
     * @return Mend_Builder_Mail
     */
    public function clearToAddresses()
    {
        if (isset($this->_addresses['to'])) {
            $this->_addresses['to'] = array();
        }
        return $this;
    }

    /**
     * Add a "BCC" Address
     *
     * @param string $address The Address
     * @param string $display The Display Name
     *
     * @return Mend_Builder_Mail
     */
    public function withBccAddress($address, $display = null)
    {
        assert('$this->isEmail($address) && (is_string($display) || is_null($display))');
        if (is_null($display)) {
            $this->_addresses['bcc'][] = $address;
        } else {
            $this->_addresses['bcc'][$display] = $address;
        }
        return $this;
    }

    /**
     * Add a "CC" Address
     *
     * @param string $address The Address
     * @param string $display The Display Name
     *
     * @return Mend_Builder_Mail
     */
    public function withCcAddress($address, $display = null)
    {
        assert('$this->isEmail($address) && (is_string($display) || is_null($display))');
        if (is_null($display)) {
            $this->_addresses['cc'][] = $address;
        } else {
            $this->_addresses['cc'][$display] = $address;
        }
        return $this;
    }

    /**
     * Add a "To" Address
     *
     * @param string $address The Address
     * @param string $display The Display Name
     *
     * @return Mend_Builder_Mail
     */
    public function withToAddress($address, $display = null)
    {
        assert('$this->isEmail($address) && (is_string($display) || is_null($display))');
        if (is_null($display)) {
            $this->_addresses['to'][] = $address;
        } else {
            $this->_addresses['to'][$display] = $address;
        }
        return $this;
    }

    /**
     * "From" Address Mutator
     *
     * @param string $address The Address
     * @param string $display The Display Name
     *
     * @return Mend_Builder_Mail
     */
    public function withFromAddress($address, $display = null)
    {
        assert('$this->isEmail($address) && (is_string($display) || is_null($display))');
        if (is_null($display)) {
            $this->_addresses['from'] = array($address);
        } else {
            $this->_addresses['from'] = array($display => $address);
        }
        return $this;
    }

    /**
     * "Reply-To" Address Mutator
     *
     * @param string $address The Address
     * @param string $display The Display Name
     *
     * @return Mend_Builder_Mail
     */
    public function withReplyToAddress($address, $display = null)
    {
        assert('$this->isEmail($address) && (is_string($display) || is_null($display))');
        if (is_null($display)) {
            $this->_addresses['reply-to'] = array($address);
        } else {
            $this->_addresses['reply-to'] = array($display => $address);
        }
        return $this;
    }

    /**
     * Subject Mutator
     *
     * @param string $subject The Subject
     *
     * @return Mend_Builder_Mail
     */
    public function withSubject($subject)
    {
        assert('is_string($subject)');
        $this->_subject = $subject;
        return $this;
    }

    /**
     * HTML Layout Mutator
     *
     * @param Zend_Layout $layout   The Layout
     * @param string      $template The Layout Template
     *
     * @return Mend_Builder_Mail
     */
    public function withHtmlLayout(Zend_Layout $layout, $template)
    {
        assert('file_exists($layout->getScriptPath($template.".phtml"))');
        $this->_layoutHtml = $layout->setLayout($template);
        return $this;
    }

    /**
     * Text Layout Mutator
     *
     * @param Zend_Layout $layout   The Layout
     * @param string      $template The Layout Template
     *
     * @return Mend_Builder_Mail
     */
    public function withTextLayout(Zend_Layout $layout, $template)
    {
        assert('file_exists($layout->getScriptPath($template.".phtml"))');
        $this->_layoutText = $layout->setLayout($template);
        return $this;
    }

    /**
     * HTML View Mutator
     *
     * @param Zend_View $view     The View
     * @param string    $template The View Template
     *
     * @return Mend_Builder_Mail
     */
    public function withHtmlView(Zend_View $view, $template)
    {
        assert('file_exists($view->getScriptPath($template.".phtml"))');
        $this->_viewHtml = $view;
        $this->_viewHtmlTemplate = $template;
        return $this;
    }

    /**
     * Text View Mutator
     *
     * @param Zend_View $view     The View
     * @param string    $template The View Template
     *
     * @return Mend_Builder_Mail
     */
    public function withTextView(Zend_View $view, $template)
    {
        assert('file_exists($view->getScriptPath($template.".phtml"))');
        $this->_viewText = $view;
        $this->_viewTextTemplate = $template;
        return $this;
    }

    /**
     * Validate an Email
     *
     * @param string $address An Email Address
     *
     * @return bool
     */
    private function isEmail($address)
    {
        return $this->_validator->isValid($address);
    }
}
