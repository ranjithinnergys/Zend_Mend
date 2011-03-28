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
 * Abstract Domain Model
 *
 * @category  Zend_Mend
 * @package   Models
 * @author    Doug Hurst <doug@echoeastcreative.com>
 * @copyright 2011 Echo East Creative, LLC
 * @license   http://www.opensource.org/licenses/bsd-license New BSD License
 * @link      http://martinfowler.com/eaaCatalog/domainModel.html
 * @link      https://github.com/echoeastcreative/Zend_Mend
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
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
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
        return isset($this->data[$offset]);
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
        unset($this->data[$offset]);
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
     * Decomposes a domain into internal types
     *
     * @param array|null $candidate_data Optional array of domains to process
     *
     * @return array
     */
    public function toArray(array $candidate_data = null)
    {
        $data = array();
        if ($candidate_data === null) {
            $candidate_data = $this->data;
        }

        foreach ($candidate_data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->toArray($value);
            }
            if ($value instanceof Mend_Model_DomainAbstract) {
                $data[$key] = $value->toArray();
            }
            if (is_object($value)) {
                $data[$key] = (array) $value;
            } else {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * Populate from Array
     *
     * @param mixed $data Data which can be used to populate a domain
     *
     * @return $this Provides fluent interface
     */
    public function populate($data)
    {
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
                }
                if (is_object($value)) {
                    throw new DomainException('Cannot populate an instance of '.get_class($object).'.');
                } else {
                    $this->$property = $data[$property];
                }
            }
        }

        return $this;
    }
}
