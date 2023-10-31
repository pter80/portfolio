<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
//use Doctrine\ORM\Tools\Setup;
require_once "vendor/autoload.php";

//$paths = array("/src","plop");
$isDevMode = false;
$proxyDir=false;
$cache=null;
// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'pter_root',
    'password' => 'plopplip',
    'dbname'   => 'BTS',
);
$useSimpleAnnotationReader = false;

$config = ORMSetup::createAttributeMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);


