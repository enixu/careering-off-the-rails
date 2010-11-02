<?php

$args = $_SERVER['argv'];

require('../libs/agavi/agavi.php');
require('../app/config.php');

Agavi::bootstrap('development');
$database = AgaviContext::getInstance('web')->getDatabaseManager()->getDatabase('doctrine');

$_SERVER['argv'] = $args;
$classLoader = new \Doctrine\Common\ClassLoader('Symfony', __DIR__ . '/../libs/doctrine2-orm/lib/vendor');
$classLoader->register();
	
$helpers = array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($database->getEntityManager()->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($database->getEntityManager())
);

$cli = new \Symfony\Component\Console\Application('Doctrine Command Line Interface', Doctrine\Common\Version::VERSION);
$cli->setCatchExceptions(true);
$helperSet = $cli->getHelperSet();
foreach ($helpers as $name => $helper) {
    $helperSet->set($helper, $name);
}

$cli->addCommands(array(
    // DBAL Commands
    new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
    new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),

    // ORM Commands
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
    new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
    new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),

));
$cli->run();
