<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category   Zend_Mend
 * @package    Form
 * @subpackage Elements
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://github.com/dalanhurst/Zend_Mend
 */

/**
 * US Federal Employee Identification Number (FEIN) Form Element
 *
 * @category   Zend_Mend
 * @package    Form
 * @subpackage Elements
 * @author     Doug Hurst <dalan.hurst@gmail.com>
 * @copyright  2011 Doug Hurst
 * @license    http://www.opensource.org/licenses/bsd-license New BSD License
 * @link       http://dev.w3.org/html5/markup/input.number.html
 * @link       http://github.com/dalanhurst/Zend_Mend
 */
class Mend_Form_Element_UsFein extends Zend_Form_Element_Text
{
    /**
     * @var array Set of accepted IRS FEIN prefixes
     */
    private $_prefixes = array(
            //  Andover
            '10', '12',
            //  Atlanta
            '60', '67',
            //  Austin
            '50', '53',
            //  Brookhaven
            '01', '02', '03', '04', '05', '06', '11', '13', '14', '16', '21',
            '22', '23', '25', '34', '51', '52', '54', '55', '56', '57', '58',
            '59', '65',
            //  Cincinnati
            '30', '32', '35', '36', '37', '38', '61',
            //  Fresno
            '15', '24',
            //  Kansas City
            '40', '44',
            //  Memphis
            '94', '95',
            //  Ogden
            '80', '90',
            //  Philadelphia
            '33', '39', '41', '42', '43', '48', '62', '63', '64', '66', '68',
            '71', '72', '73', '74', '75', '76', '77', '81', '82', '83', '84',
            '85', '86', '87', '88', '91', '92', '93', '98', '99',
            //  Internet
            '20', '26', '27', '45', '46', '47'
        );

    /**
     * (non-PHPdoc)
     * @see Zend_Form_Element::init()
     */
    public function init()
    {
        $this
            ->setAttrib('maxlength', 10)
            ->addFilter(new Zend_Filter_Digits())
            ->addValidator(new Zend_Validate_StringLength(array('min' => 9, 'max' => 9)), true)
            ->addValidator(new Zend_Validate_Regex('/^('.implode('|', $this->_prefixes).')/'), true);
    }
}
