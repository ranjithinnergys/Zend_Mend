<?php

class Mend_Form_Element_EmailTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Form_Element_Email';

	public function testCanInstantiateClass()
	{
	    $this->assertInstanceOf($this->_classname, new $this->_classname('email'));
	}
}