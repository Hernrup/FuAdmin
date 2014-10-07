<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager;

class Doctrine
{
    public $em;
    public $connection_options;
    public $config;
    public function __construct()
    {
        // require_once __DIR__ . '/Doctrine/ORM/Tools/Setup.php';
        // Setup::registerAutoloadDirectory(__DIR__);

        // Load the database configuration from CodeIgniter
        require APPPATH . 'config/database.php';

        $this->connection_options = array(
            'driver'        => $db['default']['dbdriver'],
            'user'          => $db['default']['username'],
            'password'      => $db['default']['password'],
            'host'          => $db['default']['hostname'],
            'dbname'        => $db['default']['database'],
            'charset'       => $db['default']['char_set'],
            'sslmode'       => 'true',
            'port'          => 5432,
            'driverOptions' => array(
                'charset'   => $db['default']['char_set'],
            ),
        );

        // With this configuration, your model files need to be in application/models/Entity
        // e.g. Creating a new Entity\User loads the class from application/models/Entity/User.php
        $models_namespace = 'Entity';
        $models_path = APPPATH . 'models';
        $proxies_dir = APPPATH . 'models/Proxies';
        $metadata_paths = array(APPPATH . 'models');

        // Set $dev_mode to TRUE to disable caching while you develop

        $this->config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies_dir);
        $this->em = EntityManager::create($this->connection_options, $this->config);

        // $loader = new ClassLoader($models_namespace, $models_path);
        // $loader->register();
        // $classLoader = new ClassLoader('Doctrine\DBAL\Migrations', APPPATH.'/libraries/Doctrine/DBAL/Migrations');
        // $classLoader->register();
        // $classLoader->register();
    }
}