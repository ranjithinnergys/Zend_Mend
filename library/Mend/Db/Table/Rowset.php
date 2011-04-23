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
 * DB Table Rowset Model
 *
 * @category   Zend_Mend
 * @package    Db
 * @subpackage Table
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Db_Table_Rowset
extends Zend_Db_Table_Rowset_Abstract
{
    /**
     * Delete every row in a rowset
     *
     * @return $this Provides fluent interface
     */
    public function delete()
    {
        foreach ($this as $row) {
            $row->delete();
        }
        return $this;
    }
}
