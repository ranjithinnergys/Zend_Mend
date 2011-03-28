<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */

/**
 * Abstract Mapper
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://martinfowler.com/eaaCatalog/dataMapper.html
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */
abstract class Mend_Model_MapperAbstract
{
    /**
     * @var string classname which corresponds to a domain class
     */
    protected $domain_classname;

    /**
     * @var Zend_Db_Table_Abstract The local instance of a table object
     */
    protected $db_tables = array();

    /**
     * Constructor
     *
     * @access protected
     */
    protected function __construct()
    {
    }

    /**
     * Magic Clone
     *
     * Doesn't make sense to clone a singleton
     *
     * @access protected
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * Factory
     *
     * @param string $name Name of mapper to instantiate
     *
     * @return Mend_Model_MapperAbstract
     */
    public static function factory($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Mapper name must be a string.');
        }

        //  Create classname
        $classname = 'Application_Model_'.$name.'Mapper';
        if (!class_exists($classname)) {
            if (class_exists($name)) {
                $classname = $name;
            } else {
                throw new LogicException($classname.' does not exist.');
            }
        }

        //  Create mapper
        $mapper = new $classname();
        if (!($mapper instanceof Mend_Model_MapperAbstract)) {
            throw new LogicException($classname.' is not a mapper.');
        }

        return $mapper;
    }

    /**
     * Sets the local instance of this mapper's Zend_Db_Table object
     *
     * @param string      $name   DB table name
     * @param string|null $schema DB table schema
     *
     * @return $this Provides fluent interface
     */
    protected function addDbTable($name, $schema = null)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('DB table name must be a string');
        }
        if ($schema !== null && !is_string($schema)) {
            throw new InvalidArgumentException('DB schema name must be a string.');
        }

        //  Create new Zend_Db_Table
        $config = array('name' => $name);
        if ($schema !== null) {
            $config['schema'] = $schema;
        }
        $dbTable = new Zend_Db_Table($config);

        //  Add to array
        $key = strtolower(
            $dbTable->info(Zend_Db_Table::SCHEMA).'.'.
            $dbTable->info(Zend_Db_Table::NAME)
        );
        $this->db_tables[$key] = $dbTable;

        return $this;
    }

    /**
     * Gets or Lazy-Loads a Zend_Db_Table object
     *
     * @param string $key schema_name.table_name
     *
     * @return Zend_Db_Table
     */
    protected function getDbTable($key)
    {
        if (!is_string($key)) {
            throw new InvalidArgumentException('DB table key must be a string.');
        }
        if (strpos($key, '.') === false) {
            throw new InvalidArgumentException('DB table key must contain schema.');
        }
        if (!isset($this->db_tables[$key])) {
            $schema = substr($key, 0, strpos($key, '.'));
            $name = substr($key, (strpos($key, '.') + 1));
            $this->addDbTable($name, $schema);
        }

        return $this->db_tables[$key];
    }

    /**
     * Create an empty domain object
     *
     * @return Mend_Model_DomainAbstract
     */
    public function create()
    {
        return new $this->domain_classname();
    }

    /**
     * Fetch a model by unique identifier
     *
     * @param mixed $id A value which identifies a unique domain object
     *
     * @return Mend_Model_DomainAbstract|null
     */
    abstract public function fetch($id);

    /**
     * Save
     *
     * @param Mend_Model_DomainAbstract $domain A domain object
     *
     * @return $this Provides fluent interface
     */
    abstract public function save(Mend_Model_DomainAbstract $domain);

    /**
     * Delete
     *
     * @param mixed $id A value which identifies a unique domain object
     *
     * @return $this Provides fluent interface
     */
    abstract public function delete($id);
}