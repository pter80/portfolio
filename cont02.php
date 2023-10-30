<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('Vues/');
$twig = new \Twig\Environment($loader);

//echo $twig->render('index', ['name' => 'Fabien']);
$array = [
    "foo" => "bar",
    "bar" => "foo",
];
echo $twig->render('index.html', ['the' => 'variables', 'go' => 'here','array'=>$array]);
