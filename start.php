<?php
require_once "vendor/autoload.php";
session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

//use Entity\Product;

$paths = array("Entity","toto");
$isDevMode = true;
$proxyDir=null;
$cache=null;
// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'pter',
    'password' => 'plopplip',
    'dbname'   => 'BTS',
);
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."Entity"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);



$class = "Controllers\\" . (isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'IndexController');
$target = isset($_GET['t']) ? $_GET['t'] : "index";
$getParams = isset($_GET['c']) ? $_GET['c'] : null;
$postParams = isset($_POST) ? $_POST : null;


$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

$params = array(array(
    "url"=>"http://195.154.118.169/pter/site/",
    "get"=>$getParams,
    "em"=>$entityManager
));

if ($class == "Controllers\IndexController" && in_array($target, get_class_methods($class))) // si c = index et qu'on a un t = methode existante de c
{ 
    $class = new Controllers\IndexController; // c = index
    call_user_func_array([$class, $target], $params); // c = index et t = la methode existante
} else 
{ // dans tout les autres cas ou c != index et t n'existe pas alors
    $class = new $class; // c = index 
    call_user_func_array([$class, $target],$params); 
}