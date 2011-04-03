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
 * Abstract DbTable Model
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://martinfowler.com/eaaCatalog/domainModel.html
 * @link      https://github.com/echoeastcreative/Zend_Mend
 */
abstract class Mend_Model_DbTableAbstract
extends Zend_Db_Table_Abstract
{

    /**
     * The schema name (default null means current schema)
     *
     * @var array
     */
    protected $_schema = null;

    /**
     * The table name.
     *
     * @var string
     */
    protected $_name = null;

    /**
     * Associative array map of declarative referential integrity rules.
     * This array has one entry per foreign key in the current table.
     * Each key is a mnemonic name for one reference rule.
     *
     * Each value is also an associative array, with the following keys:
     * - columns       = array of names of column(s) in the child table.
     * - refTableClass = class name of the parent table.
     * - refColumns    = array of names of column(s) in the parent table,
     *                   in the same order as those in the 'columns' entry.
     * - onDelete      = "cascade" means that a delete in the parent table also
     *                   causes a delete of referencing rows in the child table.
     * - onUpdate      = "cascade" means that an update of primary key values in
     *                   the parent table also causes an update of referencing
     *                   rows in the child table.
     *
     * @var array
     */
    protected $_referenceMap = array();

    /**
     * Simple array of class names of tables that are "children" of the current
     * table, in other words tables that contain a foreign key to this one.
     * Array elements are not table names; they are class names of classes that
     * extend Zend_Db_Table_Abstract.
     *
     * @var array
     */
    protected $_dependentTables = array();

    /**
     * Parse an ENUM() Column as an Array
     *
     * @param string $column_name
     *
     * @return array
     * @throws DomainException
     */
    public function parseEnumColumn($column_name)
    {

        $metadata = $this->info(Zend_Db_Table::METADATA);
        if (strpos($metadata[$column_name]['DATA_TYPE'], 'enum') === false) {
            throw new DomainException('"'.$column_name.'" is not an ENUM() column.');
        }

        $unrequested_types = explode(
        	',',
            substr(
                $metadata['type']['DATA_TYPE'],
                5,
                (strlen($metadata['type']['DATA_TYPE']) - 6)
            )
        );
        array_walk(
            $unrequested_types,
            function(&$type) { $type = trim(stripslashes($type), "'"); }
        );

        return $unrequested_types;
    }
}
