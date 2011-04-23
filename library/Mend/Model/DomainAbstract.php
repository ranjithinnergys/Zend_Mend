<?php
/**
 * Mend Library
 *
 * PHP version 5.3
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://github.com/dalanhurst/Zend_Mend
 */

/**
 * Abstract Domain Model
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <dalan.hurst@gmail.com>
 * @copyright 2011 Doug Hurst
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://martinfowler.com/eaaCatalog/domainModel.html
 * @link      http://github.com/dalanhurst/Zend_Mend
 */
abstract class Mend_Model_DomainAbstract
implements ArrayAccess, Serializable
{

    /**
     * @var array This object's domain-specific data
     */
    protected $data = array();

    /**
     * Magic Mutator
     *
     * @param string $name  Name of magic property
     * @param mixed  $value Value of magic property
     *
     * @return void
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->data)) {
            $this->data[$name] = $value;
        }
    }

    /**
     * Magic Accessor
     *
     * @param string $name Name of magic property
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    /**
     * Magic isset()
     *
     * @param string $name Name of magic property
     *
     * @return boolean
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * Magic unset()
     *
     * @param string $name Name of magic property
     *
     * @return void
     */
    public function __unset($name)
    {
        $this->data[$name] = null;
    }

    /**
     * Set an array value by offset
     *
     * @param int   $offset Array offset
     * @param mixed $value  Value to set
     *
     * @return void
     * @link http://www.php.net/manual/en/class.arrayaccess.php
     */
    public function offsetSet($offset, $value)
    {
        if (array_key_exists($offset, $this->data)) {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Check if offset exists
     *
     * @param int $offset Array offset
     *
     * @return boolean
     * @link http://www.php.net/manual/en/class.arrayaccess.php
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * Unset array offset
     *
     * @param int $offset Array offset
     *
     * @return void
     * @link http://www.php.net/manual/en/class.arrayaccess.php
     */
    public function offsetUnset($offset)
    {
        $this->data[$offset] = null;
    }

    /**
     * Get array offset
     *
     * @param int $offset Array offset
     *
     * @return mixed
     * @link http://www.php.net/manual/en/class.arrayaccess.php
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * Serialize domain
     *
     * @return string
     * @link http://www.php.net/manual/en/class.serializable.php
     */
    public function serialize()
    {
        return serialize($this->toArray());
    }

    /**
     * Unserialize domain
     *
     * @param string $serialized A serialized domain object
     *
     * @return void
     * @link http://www.php.net/manual/en/class.serializable.php
     */
    public function unserialize($serialized)
    {
        $this->populate(unserialize($serialized));
    }

    /**
     * Domain to Array
     *
     * Decomposes a domain into internal types.
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
        $callback = function($value, $key) use (&$data, &$callback)
        {
            //  If $value is scalar, assign
            if (!is_object($value) && !is_array($value)) {
                $data[$key] = $value;
            }

            //  If $value contains another domain object, call toArray()
            if ($value instanceof Mend_Model_DomainAbstract) {
                $data[$key] = $value->toArray();
                $value = null;                  // disables further processing
            }

            //  If $value is some other sort of object, attempt to cast it
            if (is_object($value)) {
                $value = (array) $value;
            }

            //  Recur into arrays
            if (is_array($value)) {
                $parent_data = $data;           //  store current data
                $data = array();                //  initialize new array
                array_walk($value, $callback);  //  recursive closure(!)
                $parent_data[$key] = $data;     //  store result of recursion
                $data = $parent_data;           //  reset current data
            }
        };

        array_walk($this->data, $callback);

        return $data;
    }

    /**
     * Populate from Array
     *
     * @param array|Zend_Form $data Data which can be used to populate a domain
     *
     * @return $this Provides fluent interface
     * @throws InvalidArgumentException
     */
    public function populate($data)
    {
        //  Convert Zend_Form to an array
        if ($data instanceof Zend_Form) {
            $data = $data->getValues();
        }
        if (!is_array($data)) {
            throw new InvalidArgumentException();
        }

        foreach ($this->data as $property => $value) {
            if (isset($data[$property])) {
                if ($value instanceof Mend_Model_DomainAbstract) {
                    $this->$property->populate($data[$property]);
                } else if (is_object($value)) {
                    $this->$property = $this->populateOther($value, $data[$property]);
                } else {
                    $this->$property = $data[$property];
                }
            }
        }

        return $this;
    }

    /**
     * Populate an arbitrary object
     *
     * This method is intended to be overridden with logic for populating
     * an object other than a Mend_Model_DomainAbstract instance.
     *
     * @param mixed $object The object
     * @param mixed $data   The data to populate $object
     *
     * @return $object
     * @throws InvalidArgumentException
     * @throws DomainException
     */
    protected function populateOther($object, $data)
    {
        if (!is_object($object)) {
            throw new InvalidArgumentException();
        }
        throw new DomainException('Cannot populate an instance of '.get_class($object).'.');
    }
}
