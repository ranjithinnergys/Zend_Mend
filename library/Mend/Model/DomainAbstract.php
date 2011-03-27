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
 * Abstract Domain Model
 *
 * @since Feb 17, 2011
 * @author Doug Hurst <doug@echoeastcreative.com>
 * @link http://martinfowler.com/eaaCatalog/domainModel.html
 */
abstract class Mend_Model_DomainAbstract
    implements ArrayAccess, Serializable
{

	/**
	 * @var array This object's domain-specific data
	 */
	protected $_data = array();

	/**
	 * Magic Mutator

	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		if (array_key_exists($name, $this->_data)) {
			$this->_data[$name] = $value;
		}
	}

	/**
	 * Magic Accessor
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		if (array_key_exists($name, $this->_data)) {
			return $this->_data[$name];
		}
	}

	/**
	 * Magic isset()
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function __isset($name)
	{
		return array_key_exists($name, $this->_data);
	}

	/**
	 * Magic unset()
	 *
	 * @param string $name
	 */
	public function __unset($name)
	{
		$this->_data[$name] = null;
	}

	/**
	 * Set an array value by offset
	 *
	 * @param int $offset
	 * @param mixed $value
	 * @link http://www.php.net/manual/en/class.arrayaccess.php
	 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->_data[] = $value;
		} else {
			$this->_data[$offset] = $value;
		}
	}

	/**
	 * Check if offset exists
	 *
	 * @param int $offset
	 * @return boolean
	 * @link http://www.php.net/manual/en/class.arrayaccess.php
	 */
	public function offsetExists($offset)
	{
		return isset($this->_data[$offset]);
	}

	/**
	 * Unset array offset
	 *
	 * @param int $offset
	 * @link http://www.php.net/manual/en/class.arrayaccess.php
	 */
	public function offsetUnset($offset)
	{
		unset($this->_data[$offset]);
	}

	/**
	 * Get array offset
	 *
	 * @param int $offset
	 * @return mixed
	 * @link http://www.php.net/manual/en/class.arrayaccess.php
	 */
	public function offsetGet($offset)
	{
		return isset($this->_data[$offset]) ? $this->_data[$offset] : null;
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
	 * @param array|null $candidateData Optional array of domains to process
	 * @return array
	 */
	public function toArray(array $candidateData = null)
	{
		$data = array();
		if ($candidateData === null) $candidateData = $this->_data;

		foreach ($candidateData as $key => $value) {
			if (is_array($value)) $data[$key] = $this->toArray($value);
			if ($value instanceof Mend_Model_DomainAbstract) $data[$key] = $value->toArray();
			if (is_object($value)) $data[$key] = (array) $value;
			else $data[$key] = $value;
		}

		return $data;
	}

	/**
	 * Populate from Array
	 *
	 * @param mixed $data Object containing data which can be used to populate a domain
	 * @return $this Provides fluent interface
	 */
	public function populate($data)
	{
		if($data instanceof Zend_Form) $data = $data->getValues();
		if(!is_array($data)) throw new InvalidArgumentException();

		foreach ($this->_data as $property => $value) {
			if (isset($data[$property])) {
				if ($value instanceof Mend_Model_DomainAbstract) $this->$property->populate($data[$property]);
				if (is_object($value)) {
				    throw new DomainException('Cannot populate an instance of '.get_class($object).'.');
				}
				else $this->$property = $data[$property];
			}
		}

		return $this;
	}
}