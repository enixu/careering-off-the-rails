<?php

class Doctrine2ContextEventListener
{
	public function postLoad(\Doctrine\ORM\Event\LifecycleEventArgs $eventArgs)
	{
		if ($eventArgs->getEntity() instanceof \AgaviIModel) {
			$eventArgs->getEntity()->initialize($eventArgs->getEntityManager()->getConfiguration()->getContext());
		}
	}
}

?>