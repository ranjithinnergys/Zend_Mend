<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */

/**
 * Domain Mock Object
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */
class Mend_Model_DomainAbstract_DomainMock extends Mend_Model_DomainAbstract
{

    /**
     * @var array This object's domain-specific data
     */
    protected $data = array(
        'property_1' => null
    );
}


/**
 * Abstract Domain Model Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */
class Mend_Model_DomainAbstractTest extends PHPUnit_Framework_TestCase
{
    private $_classname = 'Mend_Model_DomainAbstract_DomainMock';

	/**
	 * Class Instantiation Test
	 *
	 * @return void
	 */
	public function testCanInstantiateClass()
	{
	    $this->assertInstanceOf($this->_classname, new $this->_classname());
	}

	/**
	 * Magic Method: __get() and __set() Test 1
	 *
	 * @return void
	 */
	public function testMagicGetAndSetAccessAndMutateDataArray()
	{
	    $domain = new $this->_classname();
	    $domain->property_1 = 'Test';
	    $this->assertEquals('Test', $domain->property_1);
	}

	/**
	 * Magic Method: __get() and __set() Test 2
	 *
	 * @return void
	 */
	public function testMagicGetAndSetAccessAndMutateDataArray2()
	{
	    $domain = new $this->_classname();
	    $domain->property_2 = 'Test';
	    $this->assertNull($domain->property_2);
	}

	/**
	 * Magic Method: __isset() Test 1
	 *
	 * @return void
	 */
	public function testMagicIsSetRespondsToDataArray()
	{
	    $domain = new $this->_classname();
	    $this->assertTrue(isset($domain->property_1));
	}

	/**
	 * Magic Method: __isset() Test 2
	 *
	 * @return void
	 */
	public function testMagicIsSetRespondsToDataArray2()
	{
	    $domain = new $this->_classname();
	    $this->assertFalse(isset($domain->property_2));
	}

	/**
	 * Magic Method: __unset() Test 1
	 *
	 * @return void
	 */
	public function testMagicUnsetNullsValueInDataArray()
	{
	    $domain = new $this->_classname();
	    unset($domain->property_1);
	    $this->assertNull($domain->property_1);
	}

	/**
	 * ArrayAccess Test 1
	 *
	 * @return void
	 */
	public function testDomainModelImplementsArrayAccessInterface()
	{
	    $domain = new $this->_classname();
	    $domain['property_1'] = 'Test';
	    $this->assertEquals('Test', $domain['property_1']);
	}

	/**
	 * ArrayAccess Test 2
	 *
	 * @return void
	 */
	public function testDomainModelImplementsArrayAccessInterface2()
	{
	    $domain = new $this->_classname();
	    $domain[] = 'Test';
	    $this->assertNull($domain[0]);
	}

	/**
	 * ArrayAccess Test 3
	 *
	 * @return void
	 */
	public function testDomainModelImplementsArrayAccessInterface3()
	{
	    $domain = new $this->_classname();
	    $this->assertTrue(isset($domain['property_1']));
	}

	/**
	 * ArrayAccess Test 4
	 *
	 * @return void
	 */
	public function testDomainModelImplementsArrayAccessInterface4()
	{
	    $domain = new $this->_classname();
	    $this->assertFalse(isset($domain['property_2']));
	}

	/**
	 * Serializable Test 1
	 *
	 * @return void
	 */
	public function testDomainModelImplementsSerializableInterface()
	{
	    $domain = new $this->_classname();
	    $this->assertInternalType('string', serialize($domain));
	}

	/**
	 * Serializable Test 2
	 *
	 * @return void
	 */
	public function testDomainModelImplementsSerializableInterface2()
	{
	    $domain = new $this->_classname();
	    $domain->property_1 = 'Test';
	    $serialized = serialize($domain);
	    unset($domain);
	    $domain = unserialize($serialized);
	    $this->assertInstanceOf($this->_classname, $domain);
	}

	/**
	 * toArray() Test 1
	 *
	 * @return void
	 */
	public function testDomainCanBeCastAsArray()
	{
	    $domain = new $this->_classname();
	    $this->assertInternalType('array', $domain->toArray());
	}

	/**
	 * toArray() Test 2
	 *
	 * @return void
	 */
	public function testDomainCanBeCastAsArray2()
	{
	    $domain = new $this->_classname();
	    $domain->property_1 = 'Test';
	    $data = $domain->toArray();
	    $this->assertEquals('Test', $data['property_1']);
	}

	/**
	 * toArray() Test 3
	 *
	 * @return void
	 */
	public function testDomainCanBeCastAsArray3()
	{
	    $domain2 = new $this->_classname();
	    $domain2->property_1 = 'Test';
	    $domain1 = new $this->_classname();
	    $domain1->property_1 = $domain2;
	    $data = $domain1->toArray();
	    $this->assertInternalType('array', $data['property_1']);
	    $this->assertEquals('Test', $data['property_1']['property_1']);
	}

	/**
	 * toArray() Test 4
	 *
	 * @return void
	 */
	public function testDomainCanBeCastAsArray4()
	{
	    $domain2 = new $this->_classname();
	    $domain2->property_1 = 'Test domain2';
	    $domain3 = new $this->_classname();
	    $domain3->property_1 = 'Test domain3';
	    $domain1 = new $this->_classname();
	    $domain1->property_1 = array('Plain Array Element', $domain2, $domain3);
	    $data = $domain1->toArray();
	    $this->assertInternalType('array', $data['property_1']);
	    $this->assertInternalType('string', $data['property_1'][0]);
	    $this->assertInternalType('array', $data['property_1'][1]);
	    $this->assertInternalType('array', $data['property_1'][2]);
	    $this->assertEquals('Plain Array Element', $data['property_1'][0]);
	    $this->assertEquals('Test domain2', $data['property_1'][1]['property_1']);
	    $this->assertEquals('Test domain3', $data['property_1'][2]['property_1']);
	}

	/**
	 * toArray() Test 5
	 *
	 * @return void
	 */
	public function testDomainCanBeCastAsArray5()
	{
	    $object = new stdClass();
	    $domain = new $this->_classname();
	    $domain->property_1 = $object;
	    $data = $domain->toArray();
	    $this->assertInternalType('array', $data['property_1']);
	    $this->assertEquals(0, count($data['property_1']));
	}

	/**
	 * populate(Array) Test 1
	 *
	 * @return void
	 */
	public function testDomainCanBePopulatedFromAnArray()
	{
	    $this->setExpectedException('InvalidArgumentException');
	    $domain = new $this->_classname();
	    $domain->populate(0);
	}

	/**
	 * populate(Array) Test 2
	 *
	 * @return void
	 */
	public function testDomainCanBePopulatedFromAnArray2()
	{
	    $domain = new $this->_classname();
	    $domain->populate(array('property_1' => 'Test'));
	    $this->assertEquals('Test', $domain->property_1);
	}

	/**
	 * populate(Array) Test 3
	 *
	 * @return void
	 */
	public function testDomainCanBePopulatedFromAnArray3()
	{
	    $this->setExpectedException('DomainException');
	    $domain = new $this->_classname();
	    $domain->property_1 = new stdClass();
	    $domain->populate(array('property_1' => 'Test'));
	}

	/**
	 * populate(Array) Test 4
	 *
	 * @return void
	 */
	public function testDomainCanBePopulatedFromAnArray4()
	{
	    $domain = new $this->_classname();
	    $subdomain = new $this->_classname();
	    $domain->property_1 = $subdomain;
	    $domain->populate(array('property_1' => array('property_1' => 'Test')));
	    $this->assertEquals('Test', $domain->property_1->property_1);
	}

	/**
	 * populate(Zend_Form) Test 1
	 *
	 * @return void
	 */
	public function testDomainCanBePopulatedFromAZendFrom()
	{
	    $form = new Zend_Form();
	    $input = new Zend_Form_Element_Text('property_1');
	    $form->addElement($input);

	    $domain = new $this->_classname();
	    $domain->populate($form);
	    $this->assertNull($domain->property_1);
	}

	/**
	 * populate(Zend_Form) Test 2
	 *
	 * @return void
	 */
	public function testDomainCanBePopulatedFromAZendFrom2()
	{
	    $form = new Zend_Form();
	    $input = new Zend_Form_Element_Text('property_1');
	    $form->addElement($input);
	    $form->getElement('property_1')->setValue('Test');

	    $domain = new $this->_classname();
	    $domain->populate($form);
	    $this->assertEquals('Test', $domain->property_1);
	}
}