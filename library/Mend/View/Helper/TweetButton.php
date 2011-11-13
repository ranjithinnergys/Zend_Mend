<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Tweet Button Fluent Builder View Helper
 *
 * @category   Zend_Mend
 * @package    View
 * @subpackage Helpers
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_View_Helper_TweetButton extends Zend_View_Helper_Abstract
{

    /**
     * @var string HTTP Referrer
     */
    private $_url;

    /**
     * @var string via user
     */
    private $_via;

    /**
     * @var string Tweet text
     */
    private $_text;

    /**
     * @var string Recommended accounts
     */
    private $_related;

    /**
     * @var string Count box position
     */
    private $_count;

    /**
     * @var string Language
     */
    private $_lang;

    /**
     * @var string URL to which your shared URL resolves to
     */
    private $_countUrl;

    /**
     * Starts the fluent builder
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function tweetButton()
    {
        //  Clear existing
        $this->_count = null;
        $this->_counturl = null;
        $this->_lang = null;
        $this->_related = null;
        $this->_text = null;
        $this->_url = null;
        $this->_via = null;

        return $this;
    }

    /**
     * Returns tweet button
     *
     * @return string
     */
    public function build()
    {
        return '<a '
            .'href="https://twitter.com/share" '
            .'class="twitter-share-button" '
            .(is_null($this->_count) ? '' : 'data-count="'.$this->_count.'" ')
            .(is_null($this->_countUrl) ? '' : 'data-counturl="'.$this->_countUrl.'" ')
            .(is_null($this->_lang) ? '' : 'data-lang="'.$this->_lang.'" ')
            .(is_null($this->_related) ? '' : 'data-related="'.$this->_related.'" ')
            .(is_null($this->_text) ? '' : 'data-text="'.$this->_text.'" ')
            .(is_null($this->_url) ? '' : 'data-url="'.$this->_url.'" ')
            .(is_null($this->_via) ? '' : 'data-via="'.$this->_via.'" ')
            .'>Tweet</a>';
    }

    /**
     * Mutator: Count
     *
     * @param string
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withCount($count)
    {
        if (in_array($count, array('none', 'horizontal', 'vertical'))) {
            $this->_count = $count;
        }

        return $this;
    }

    /**
     * Mutator: Count URL
     *
     * @param Zend_Uri_Http
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withCountUrl(Zend_Uri_Http $countUrl)
    {
        if ($countUrl->valid()) {
            $this->_countUrl = $countUrl->getUri();
        }
        return $this;
    }

    /**
     * Mutator: Lang
     *
     * @param string
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withLang($lang)
    {
        $this->_lang = $lang;
        return $this;
    }

    /**
     * Mutator: Related
     *
     * @param string
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withRelated($related)
    {
        $this->_related = $related;
        return $this;
    }

    /**
     * Mutator: Text
     *
     * @param string
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withText($text)
    {
        if (strlen($text) <= 140) {
            $this->_text = $text;
        }
        return $this;
    }

    /**
     * Mutator: URL
     *
     * @param Zend_Uri_Http
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withUrl(Zend_Uri_Http $url)
    {
        if ($url->valid()) {
            $this->_url = $url->getUri();
        }
        return $this;
    }

    /**
     * Mutator: Via
     *
     * @param string
     *
     * @return Mend_View_Helper_TweetButton
     */
    public function withVia($via)
    {
        $this->_via = $via;
        return $this;
    }
}
