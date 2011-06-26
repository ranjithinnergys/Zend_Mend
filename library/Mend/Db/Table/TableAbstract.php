<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Db
 * @subpackage Table
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Abstract DB Table Model
 *
 * @category   Zend_Mend
 * @package    Db
 * @subpackage Table
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 * @uses       Mend_Db_Table_Rowset
 */
abstract class Mend_Db_Table_TableAbstract
extends Zend_Db_Table_Abstract
{

    /**
     * Classname for rowset
     *
     * @var string
     */
    protected $_rowsetClass = 'Mend_Db_Table_Rowset';

    /**
     * Parse an ENUM() Column as an Array
     *
     * @param string $column Column name of ENUM() type
     *
     * @return array
     * @throws DomainException
     */
    public function parseEnumColumn($column)
    {
        //  Get metadata
        $metadata = $this->info(Zend_Db_Table::METADATA);

        //  Make sure this is an enum column
        //  This may be dependent on implementation, but this method expects
        //  an ENUM() column to be represented as a string beginning with the
        //  string 'enum'
        if (strpos($metadata[$column]['DATA_TYPE'], 'enum') !== 0) {
            throw new DomainException('"'.$column.'" is not an ENUM() column.');
        }

        //  Create array of quoted values
        $enum = explode(
        	',',
            substr(
                $metadata['type']['DATA_TYPE'],
                5,
                (strlen($metadata['type']['DATA_TYPE']) - 6)
            )
        );

        //  Strip quotes
        array_walk(
            $enum,
            function(&$value) {
                $value = trim(stripslashes($value), "'");
            }
        );

        return $enum;
    }
}
