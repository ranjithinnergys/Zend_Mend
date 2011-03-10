<?php
/**
 * Zend_Mend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 *
 * @category   Zend_Mend
 * @package    Form
 * @subpackage Element
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 */

/**
 * Abstract Mapper
 *
 * The mapper implements the Data Mapper design pattern which provides
 * a layer of abstraction between the DB and the domain models. With
 * a data mapper, the domain can be ignorant of the DB schema just as
 * the DB schema is already ignorant of the domain model.
 *
 * @since Feb 13, 2011
 * @author Doug Hurst <dalan.hurst@gmail.com>
 * @link http://martinfowler.com/eaaCatalog/dataMapper.html
 */
abstract class Mend_Model_MapperAbstract extends stdClass
{

	/**
	 * @var string classname which corresponds to a Mend_Model_DomainAbstract class
	 */
	protected static $_domainClassname;

	/**
	 * @var Zend_Db_Table_Abstract The local instance of a table object
	 */
	protected $_dbTables = array();

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
	 */
	protected function __clone()
	{
	}

	/**
	 * Factory
	 *
	 * @param string $name Name of mapper to instantiate
	 * @return Mend_Model_MapperAbstract
	 */
	public static function factory($name)
	{
		if(!is_string($name)) throw new InvalidArgumentException('Mapper name must be a string.');

		//  Create classname
		$classname = 'Application_Model_'.$name.'Mapper';
		if (!class_exists($classname)) {
			if (class_exists($name)) $classname = $name;
			else throw new LogicException($classname.' does not exist.');
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
	 * @param string $name DB table name
	 * @param string|null $schema DB table schema
	 * @return $this Provides fluent interface
	 */
	protected function _addDbTable($name, $schema = null)
	{
		if (!is_string($name)) throw new InvalidArgumentException('DB table name must be a string');
		if ($schema !== null && !is_string($schema)) {
		    throw new InvalidArgumentException('DB schema name must be a string.');
		}

		//  Create new Zend_Db_Table
		$config = array('name' => $name);
		if ($schema !== null) $config['schema'] = $schema;
		$dbTable = new Zend_Db_Table($config);

		//  Add to array
		$key = strtolower($dbTable->info(Zend_Db_Table::SCHEMA).'.'.$dbTable->info(Zend_Db_Table::NAME));
		$this->_dbTables[$key] = $dbTable;

		return $this;
	}

	/**
	 * Gets or Lazy-Loads a Zend_Db_Table object
	 *
	 * @param string $key schema_name.table_name
	 * @return Zend_Db_Table
	 */
	protected function _getDbTable($key)
	{
		if (!is_string($key)) throw new InvalidArgumentException('DB table key must be a string.');
		if (strpos($key, '.') === false) throw new InvalidArgumentException('DB table key must contain schema.');
		if (!isset($this->_dbTables[$key])) {
			$schema = substr($key, 0, strpos($key, '.'));
			$name = substr($key, (strpos($key, '.') + 1));
			$this->_addDbTable($name, $schema);
		}

		return $this->_dbTables[$key];
	}

	/**
	 * Create an empty domain object
	 *
	 * @return Mend_Model_DomainAbstract
	 */
	public function create()
	{
		$classname = static::$_domainClassname;
		return new $classname();
	}

	/**
	 * Fetch a model by unique identifier
	 *
	 * @param mixed $id A vaue which identifies a unique domain object
	 * @return Mend_Model_DomainAbstract
	 */
	abstract public function fetch($id);

	/**
	 * Save
	 *
	 * @return $this Provides fluent interface
	 */
	abstract public function save(Mend_Model_DomainAbstract $domain);

	/**
	 * Delete
	 *
	 * @return $this Provides fluent interface
	 */
	abstract public function delete(Mend_Model_DomainAbstract $domain);
}