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
     * Parse an ENUM() Column as an Array
     *
     * @param string $column_name Column name of ENUM() type
     *
     * @return array
     * @throws DomainException
     */
    public function parseEnumColumn($column_name)
    {
        //  Get metadata
        $metadata = $this->info(Zend_Db_Table::METADATA);

        //  Make sure this is an enum column
        //  This may be dependent on implementation, but this method expects
        //  an ENUM() column to be represented as a string beginning with the
        //  string 'enum'
        if (strpos($metadata[$column_name]['DATA_TYPE'], 'enum') !== 0) {
            throw new DomainException('"'.$column_name.'" is not an ENUM() column.');
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
            function(&$value) { $value = trim(stripslashes($value), "'"); }
        );

        return $enum;
    }
}
