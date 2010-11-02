<?php

abstract class DomainObject extends Doctrine2AgaviModel implements ArrayAccess
{
	public function offsetExists($offset) {
		$value = $this->{"get$offset"}();
		return $value !== null;
	}

	public function offsetSet($offset, $value) {
		throw new BadMethodCallException("Array access of class " . get_class($this) . " is read-only!");
	}

	public function offsetGet($offset) {
		return $this->{"get$offset"}();
	}

	public function offsetUnset($offset) {
		throw new BadMethodCallException("Array access of class " . get_class($this) . " is read-only!");
	}
}

?>