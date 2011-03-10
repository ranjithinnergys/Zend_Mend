<?php
class Mend_Model_MapperAbstract_DomainMock extends Mend_Model_DomainAbstract
{
}

class Mend_Model_MapperAbstract_MapperMock extends Mend_Model_MapperAbstract
{
	protected static $_domainClassname = 'Mend_Model_MapperAbstract_DomainMock';

	public function _addDbTable($name, $schema = null)
	{
	    return parent::_addDbTable($name, $schema);
	}

	public function _getDbTable($key)
	{
	    return parent::_getDbTable($key);
	}

	public function delete(Mend_Model_DomainAbstract $domain)
	{
	    return;
	}

	public function fetch($id)
	{
	    return;
	}

	public function save(Mend_Model_DomainAbstract $domain)
	{
	    return;
	}
}

class Mend_Model_MapperAbstractTest extends PHPUnit_Framework_TestCase
{
	private $_classname = 'Mend_Model_MapperAbstract_MapperMock';

	public function testCannotDirectlyInstantiateConcreteImplementation()
	{
		$reflector = new ReflectionClass($this->_classname);
		$constructor = $reflector->getConstructor();
		$this->assertFalse($constructor->isPublic());
	}

	public function testCanInstantiateConcreteImplementationViaFactory()
	{
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
		$this->assertInstanceOf('Mend_Model_MapperAbstract', $mapper);
	}

	public function testCannnotCloneAMapper()
	{
		$reflector = new ReflectionClass($this->_classname);
		$clone = $reflector->getMethod('__clone');
		$this->assertFalse($clone->isPublic());
	}

	public function testFactoryRequiresStringName()
	{
		$this->setExpectedException('InvalidArgumentException');
		$mapper = Mend_Model_MapperAbstract::factory(0);
	}

	public function testFactoryRequiresClassMustExist()
	{
		$this->setExpectedException('LogicException');
		$mapper = Mend_Model_MapperAbstract::factory('XXX_DoesNotExist_XXX');
	}

	public function testFactoryRequiresClassMustBeAMapper()
	{
		$this->setExpectedException('LogicException');
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_DomainMock');
	}

	public function testAddDbTableRequiresStringName()
	{
		$this->setExpectedException('InvalidArgumentException');
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
		$mapper->_addDbTable(0, '');
	}

	public function testAddDbTableRequiresStringSchemaIfProvided()
	{
		$this->setExpectedException('InvalidArgumentException');
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
		$mapper->_addDbTable('', 0);
	}

	public function testCreateReturnsNewDomain()
	{
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
		$this->assertInstanceOf('Mend_Model_MapperAbstract_DomainMock', $mapper->create());
	}

	public function testGetDbTableRequiresStringKey()
	{
		$this->setExpectedException('InvalidArgumentException');
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
		$mapper->_getDbTable(0);
	}

	public function testGetDbTableRequiresStringSchemaDotTableAsKeyFormat()
	{
		$this->setExpectedException('InvalidArgumentException');
		$mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
		$mapper->_getDbTable('table_name_only');
	}
}