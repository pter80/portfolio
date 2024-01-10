<?php
require_once "vendor/autoload.php";
session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Twig\Extra\Intl\IntlExtension;



#[Attribute]
class Role {
    private $data1;
    
    function __construct($data1) {
        echo "Role construct";
        $this->data1=$data1;
    }
}


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
    "message"=>(isset($_GET["message"])?$_GET['message']:"Message"),
    "get"=>$getParams,
    "post"=>$postParams,
    "em"=>$entityManager
));



if ($class == "Controllers\IndexController" && in_array($target, get_class_methods($class))) // si c = index et qu'on a un t = methode existante de c
{ 
    $class = new Controllers\IndexController; // c = index
    // c = index et t = la methode existante
} else 
{ // dans tout les autres cas ou c != index et t n'existe pas alors
    $class = new $class; // c = index 
    //call_user_func_array([$class, $target],$params); 
} 

$goTo=false;

//echo "SESSION1";if(array_key_exists('Loged',$_SESSION)) var_dump($_SESSION['Loged']);
$reflection = new \ReflectionClass($class);
echo "<ul>";
$namespaceName=$reflection->getNamespaceName();
foreach ($reflection->getMethods() as $method) {
    
    if ($target== $method->getName()) {
        $attributes = $method->getAttributes(\Controllers\Role::class);
        foreach ($attributes as $attribute) {
            echo "<li>";
            echo $attribute->getName();
            if("Controllers\Role"==$attribute->getName()) {
                var_dump($attribute->getArguments());
                switch ($attribute->getArguments()[0]) { 
                    case "Anonym" :
                        $goTo = true;
                    
                    case "Admin" :
                        if (array_key_exists('Loged',$_SESSION)){
                            if ($_SESSION['Loged']) {
                                $goTo = true;
    
                            }
                        }
                    
                }
            }
            echo "</li>";
            
        }    
    }
    /*
    $attributes = $method->getAttributes(\Controllers\Route::class);
    var_dump($attributes);
    foreach ($attributes as $attribute) {
        var_dump($attribute->getArguments());
    }
    */
}
//echo "GoTo"; var_dump($goTo);
if(array_key_exists('Loged',$_SESSION)) var_dump($_SESSION['Loged']);
if ($goTo) {
    
    //$class->$target($params);
}
else {
    $class = new Controllers\UserController();
    $target= "login";
    //$class->$target($params);
}
call_user_func_array([$class, $target],$params);
