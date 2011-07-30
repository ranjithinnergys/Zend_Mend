<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Util
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Builder Interface
 *
 * @category  Zend_Mend
 * @package   Model
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
interface Mend_Model_Builder_Interface
{
    /**
     * Start Builder
     *
     * @return Mend_Model_Builder_Interface
     */
    public static function start();

    /**
     * Build Object
     *
     * @return object
     */
    public function build();
}