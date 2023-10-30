<?php

namespace Controllers;

use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    public function one($url)
    {
        //savoir si un utilisateur existe deja
	    $connectUser="Un seul";
	    var_dump($url);
        echo $this->twig->render('index.html', ['connectUser' =>   $connectUser]);
    }
    public function liste($url) {
        $connectUser="tous";
        echo $this->twig->render('index.html', ['connectUser' =>   $connectUser]);
        
    }
    #[Route('/blog', name: 'blog_list')]
    public function create() {
        try {
        	$db = new \PDO(
            		'mysql:host=localhost;dbname=BTS;charset=utf8',
            		'pter_root',
            		'plopplip'
        	);
        }
        catch (Exception $e) {
        	die("Erreur : ".$e->getMessage());
        }
        $dataStatut = $db->prepare('SELECT ville_nom,ville_id FROM villes_france_free LIMIT 20');
        $dataStatut->execute();
        $villes=$dataStatut->fetchAll();
        echo $this->twig->render('user/create.html',['villes'=>$villes]);
    }
    public function insert() {
        var_dump($_POST);
        try {
        	$db = new \PDO(
            		'mysql:host=localhost;dbname=BTS;charset=utf8',
            		'pter_root',
            		'plopplip'
        	);
        }
        catch (Exception $e) {
        	die("Erreur : ".$e->getMessage());
        }
        //$dataStatut = $db->prepare('SELECT ville_nom FROM villes_france_free LIMIT 20');
        //$dataStatut->execute();
        //$villes=$dataStatut->fetchAll();
        echo "INSERT";
    }
    
    
}
