<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Email Form Element Test
 *
 * @category  Zend_Mend
 * @package   Test
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Form_Element_EmailTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Form_Element_Email';

	/**
	 * Class Instantiation Test
	 *
	 * @return void
	 */
	public function testCanInstantiateClass()
	{
	    $this->assertInstanceOf($this->_classname, new $this->_classname('email'));
	}
}