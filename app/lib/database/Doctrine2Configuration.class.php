<?php

class Doctrine2Configuration extends \Doctrine\ORM\Configuration
{
	/**
	 * @var        AgaviContext The AgaviContext instance this View belongs to.
	 */
	protected $context = null;

	/**
	 * Retrieve the current application context.
	 *
	 * @return     AgaviContext The current AgaviContext instance.
	 *
	 * @author     Arran Walker <arran.walker@enixu.com>
	 */
	public final function getContext()
	{
		return $this->context;
	}

	/**
	 * Initialize Configuration providing AgaviContext.
	 *
	 * @param      AgaviContext An AgaviContext instance.
	 *
	 * @author     Arran Walker <arran.walker@enixu.com>
	 */
	public function initialize(AgaviContext $context)
	{
		$this->context = $context;
	}
}

?>