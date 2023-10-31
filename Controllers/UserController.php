<?php

namespace Controllers;

use Symfony\Component\Routing\Annotation\Route;
use User;

class UserController extends Controller
{
    public function one($params)
    {
        //savoir si un utilisateur existe deja
        
        $entityManager=$params["em"];
	    $connectUser="Un seul";
	    
	    $user = new User();
        $user->setNom("TERRAILLON");
        $user->setPrenom("Maxime");
        $entityManager->persist($user);
        $entityManager->flush();
        
	    echo $this->twig->render('index.html', ['connectUser' =>   $connectUser,"params"=>$params]);
    }
    
    public function liste($params) {
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
