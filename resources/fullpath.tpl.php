<?php
/**
 * Zend XHTML5
 *
 * PHP version 5.3
 *
 * @category  Zend_XHTML5
 * @package   Resources
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_XHTML5
 * @link      http://weierophinney.net/matthew/archives/245-Autoloading-Benchmarks.html
 */


/**
 * @var array Classmap
 */
$classmap = array(
    ___CLASSLIST___
);

spl_autoload_register(
    function($classname) use ($classmap)
    {
        $token = strtolower($classname);
        if (isset($classmap[$token])) {
            require $classmap[$token];
        }
    }
);