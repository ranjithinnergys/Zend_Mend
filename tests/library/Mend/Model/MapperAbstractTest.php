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
class Mend_Model_MapperAbstract_DomainMock extends Mend_Model_DomainAbstract
{
}


/**
 * Mapper Mock Object
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */
class Mend_Model_MapperAbstract_MapperMock extends Mend_Model_MapperAbstract
{
    protected $domain_classname = 'Mend_Model_MapperAbstract_DomainMock';

    /**
     * Overriding to test protected method
     *
     * @param string      $name   DB table name
     * @param string|null $schema DB table schema
     *
     * @return $this Provides fluent interface
     * @see Mend_Model_MapperAbstract::addDbTable()
     */
    public function addDbTable($name, $schema = null)
    {
        return parent::addDbTable($name, $schema);
    }

    /**
     * Overriding to test protected method
     *
     * @param string $key schema_name.table_name
     *
     * @return Zend_Db_Table
     * @see Mend_Model_MapperAbstract::getDbTable()
     */
    public function getDbTable($key = null)
    {
        return parent::getDbTable($key);
    }

    /**
     * Dummy method
     *
     * @param mixed $id A value which identifies a unique domain object
     *
     * @return $this Provides fluent interface
     * @see Mend_Model_MapperAbstract::delete()
     */
    public function delete($id)
    {
        return null;
    }

    /**
     * Dummy method
     *
     * @param mixed $id A value which identifies a unique domain object
     *
     * @return Mend_Model_DomainAbstract|null
     * @see Mend_Model_MapperAbstract::fetch()
     */
    public function fetch($id)
    {
        return null;
    }

    /**
     * Dummy method
     *
     * @param Mend_Model_DomainAbstract $domain A domain object
     *
     * @return $this Provides fluent interface
     * @see Mend_Model_MapperAbstract::save()
     */
    public function save(Mend_Model_DomainAbstract $domain)
    {
        return $this;
    }
}


/**
 * Email Form Element Test
 *
 * @category  Zend_Mend
 * @package   Tests
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */
class Mend_Model_MapperAbstractTest extends PHPUnit_Framework_TestCase
{
    private $_classname = 'Mend_Model_MapperAbstract_MapperMock';

    /**
     * Class Instantiation Test 1
     *
     * @return void
     */
    public function testCannotDirectlyInstantiateConcreteImplementation()
    {
        $reflector = new ReflectionClass($this->_classname);
        $constructor = $reflector->getConstructor();
        $this->assertFalse($constructor->isPublic());
    }

    /**
     * Class Instantiation Test 2
     *
     * @return void
     */
    public function testCanInstantiateConcreteImplementationViaFactory()
    {
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
        $this->assertInstanceOf('Mend_Model_MapperAbstract', $mapper);
    }

    /**
     * Class Instantiation Test 3
     *
     * @return void
     */
    public function testFactoryRequiresStringName()
    {
        $this->setExpectedException('InvalidArgumentException');
        $mapper = Mend_Model_MapperAbstract::factory(0);
    }

    /**
     * Class Instantiation Test 4
     *
     * @return void
     */
    public function testFactoryRequiresClassMustExist()
    {
        $this->setExpectedException('LogicException');
        $mapper = Mend_Model_MapperAbstract::factory('XXX_DoesNotExist_XXX');
    }

    /**
     * Class Instantiation Test 5
     *
     * @return void
     */
    public function testFactoryRequiresClassMustBeAMapper()
    {
        $this->setExpectedException('LogicException');
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_DomainMock');
    }

    /**
     * Doesn't make sense to clone a mapper
     *
     * @return void
     */
    public function testCannnotCloneAMapper()
    {
        $reflector = new ReflectionClass($this->_classname);
        $clone = $reflector->getMethod('__clone');
        $this->assertFalse($clone->isPublic());
    }

    /**
     * Add Zend_DB_Table Test 1
     *
     * @return void
     */
    public function testAddDbTableRequiresStringName()
    {
        $this->setExpectedException('InvalidArgumentException');
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
        $mapper->addDbTable(0, '');
    }

    /**
     * Add Zend_DB_Table Test 2
     *
     * @return void
     */
    public function testAddDbTableRequiresStringSchemaIfProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
        $mapper->addDbTable('', 0);
    }

    /**
     * Domain Creation Test
     *
     * @return void
     */
    public function testCreateReturnsNewDomain()
    {
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
        $this->assertInstanceOf('Mend_Model_MapperAbstract_DomainMock', $mapper->create());
    }

    /**
     * Get Zend_DB_Table Test 1
     *
     * @return void
     */
    public function testGetDbTableRequiresStringKey()
    {
        $this->setExpectedException('InvalidArgumentException');
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
        $mapper->getDbTable(0);
    }

    /**
     * Get Zend_DB_Table Test 2
     *
     * @return void
     */
    public function testGetDbTableRequiresStringSchemaDotTableAsKeyFormat()
    {
        $this->setExpectedException('InvalidArgumentException');
        $mapper = Mend_Model_MapperAbstract::factory('Mend_Model_MapperAbstract_MapperMock');
        $mapper->getDbTable('table_name_only');
    }
}