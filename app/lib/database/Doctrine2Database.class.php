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
		if ($this->em->getUnitOfWork()->size()) {
			$this->em->flush();
		}
	}

	public function getEntityManager()
	{
		return $this->em;
	}

	public function initialize(AgaviDatabaseManager $databaseManager, array $parameters = array())
	{
		parent::initialize($databaseManager, $parameters);

		// Doctrine autoload
		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', $parameters['orm_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', $parameters['dbal_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', $parameters['common_path']);
		$classLoader->register();

		$config = new Doctrine2Configuration();
		$config->initialize($databaseManager->getContext());

		if (!AgaviConfig::get('core.debug')) {
			$config->setMetadataCacheImpl(new Doctrine\Common\Cache\ApcCache());
			$config->setQueryCacheImpl(new Doctrine\Common\Cache\ApcCache());
		}

		$driverImpl = $config->newDefaultAnnotationDriver(array($parameters['entities']));
		$config->setMetadataDriverImpl($driverImpl);

		$config->setProxyDir($parameters['proxies']);
		$config->setProxyNamespace('Proxies');

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
}

?>