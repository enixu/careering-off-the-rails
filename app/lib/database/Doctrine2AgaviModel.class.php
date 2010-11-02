<?php

abstract class Doctrine2AgaviModel extends AgaviModel
{
	/**
	 * Initialize this model.
	 *
	 * We do this here so we don't have to use Context::getModel()
	 * which forces you to postfix models with 'Model'.
	 *
	 * @param      AgaviContext The current application context.
	 *
	 * @author     Arran Walker <arran.walker@enixu.com>
	 */
	public function __construct(AgaviContext $context)
	{
		$this->context = $context;
	}

	/**
	 * Pre-serialization callback.
	 *
	 * Will set the name of the context and exclude the instance from serializing.
	 *
	 * @author     David Zülke <dz@bitxtender.com>
	 * @author     Arran Walker <arran.walker@enixu.com>
	 * @since      0.11.0
	 */
	public function __sleep()
	{
		if ($this->context) {
			$this->_contextName = $this->context->getName();
			$arr = get_object_vars($this);
			unset($arr['context']);
			return array_keys($arr);
		}
		return array();
	}

	/**
	 * Post-unserialization callback.
	 *
	 * Will restore the context based on the names set by __sleep.
	 *
	 * @author     David Zülke <dz@bitxtender.com>
	 * @author     Arran Walker <arran.walker@enixu.com>
	 * @since      0.11.0
	 */
	public function __wakeup()
	{
		if (isset($this->_contextName)) {
			$this->context = AgaviContext::getInstance($this->_contextName);
			unset($this->_contextName);
		}
	}
}

?>