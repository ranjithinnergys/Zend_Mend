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

//  Set conforming error level
error_reporting(E_ALL | E_STRICT);

//  Maximize memory for testing
ini_set('memory_limit', '-1');

//  Class-map Autoloading
//  @link http://weierophinney.net/matthew/archives/245-Autoloading-Benchmarks.html
require_once __DIR__.'/../resources/classmap.Zend_Mend.php';
require_once __DIR__.'/../resources/classmap.Zend.php';
require_once __DIR__.'/../resources/classmap.ZendX.php';

