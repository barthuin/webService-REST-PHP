<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
require_once "./config/config.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/model/dto"), $isDevMode, null, null, false);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => DB_HOST,
    'user'     => DB_USERNAME,
    'password' => DB_PASSWORD,
    'dbname'   => DB_NAME,
    'charset'  => 'UTF8',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

?>