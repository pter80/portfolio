<?php
require_once "vendor/autoload.php";
session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

//use User;

//$paths = array("src/Entity","toto");
$isDevMode = true;
$proxyDir=null;
$cache=null;
// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'pter_root',
    'password' => 'plopplip',
    'dbname'   => 'BTS',
);
$useSimpleAnnotationReader = false;
$config = ORMSetup::createAttributeMetadataConfiguration(array(__DIR__."/src/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);



$class = "Controllers\\" . (isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'IndexController');
$target = isset($_GET['t']) ? $_GET['t'] : "index";
$getParams = isset($_GET['c']) ? $_GET['c'] : null;
$postParams = isset($_POST) ? $_POST : null;

$params = array(array(
    "url"=>"http://195.154.118.169/pter/portfolio/start.php",
    "message"=>(isset($_GET["message"])?$_GET['message']:""),
    "get"=>$getParams,
    "post"=>$postParams,
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