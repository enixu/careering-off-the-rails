<?php

/**
 * The base action from which all project actions inherit.
 */
class JobeetBaseAction extends AgaviAction
{
	public function getEntityManager()
	{
		return $this->getContext()->getDatabaseManager()->getDatabase()->getEntityManager();
	}
}

?>