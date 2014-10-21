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
            //'driver'        => $db['default']['dbdriver'],
            'driver'        => 'pdo_mysql',
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

        $models_namespace = 'Entities';
//        $models_path = APPPATH . 'models';
        $proxies_dir = APPPATH . 'models/Proxies';
        $metadata_paths = array(APPPATH . 'models/entities');

        // Set $dev_mode to TRUE to disable caching while you develop
        $this->config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies_dir);
        $this->config->setEntityNamespaces(array($models_namespace));
        $this->em = EntityManager::create($this->connection_options, $this->config);
    }

    public function truncateTable($className){
        $cmd = $this->em->getClassMetadata($className);
        $connection = $this->em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        log_message("INFO",sprintf("Table %s has been truncated",$className));
    }
}