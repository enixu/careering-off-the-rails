<?php

class Doctrine2Database extends AgaviDatabase
{
	protected $em = null;

	public function connect()
	{
		// Not required, Doctrine connects when required. Like a boss.
	}

	public function shutdown()
	{
	}

	public function getEntityManager()
	{
		if ($this->em === null) {
			$parameters = $this->getParameters();

			$config = new Doctrine2Configuration();
			$config->initialize($this->databaseManager->getContext());

			if (!AgaviConfig::get('core.debug')) {
				$config->setMetadataCacheImpl(new Doctrine\Common\Cache\ApcCache());
				$config->setQueryCacheImpl(new Doctrine\Common\Cache\ApcCache());
				$config->setResultCacheImpl(new \Doctrine\Common\Cache\ApcCache());
			}

			$driverImpl = $config->newDefaultAnnotationDriver(array($parameters['entities_path']));
			$config->setMetadataDriverImpl($driverImpl);

			$config->setProxyDir($parameters['proxy_path'].'/'.str_replace('\\', '_', $parameters['proxy_namespace']));
			$config->setProxyNamespace($parameters['proxy_namespace']);

			$connectionParams = array(
				'dbname'   => $parameters['database'],
				'user'     => $parameters['username'],
				'password' => $parameters['password'],
				'host'     => $parameters['hostname'],
				'driver'   => $parameters['driver']
			);

			$evm = new \Doctrine\Common\EventManager();
			$evm->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit($this->getParameter('charset')));
			$evm->addEventListener(array(Doctrine\ORM\Events::postLoad), new Doctrine2ContextEventListener());

			$this->em = \Doctrine\ORM\EntityManager::create($connectionParams, $config, $evm);
		}
		
		return $this->em;
	}

	public function initialize(AgaviDatabaseManager $databaseManager, array $parameters = array())
	{
		parent::initialize($databaseManager, $parameters);

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', $parameters['common_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', $parameters['orm_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', $parameters['dbal_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader($parameters['proxy_namespace'], $parameters['proxy_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader($parameters['entities_namespace'], $parameters['entities_path']);
		$classLoader->register();
	}
}

?>