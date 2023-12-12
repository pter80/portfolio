<?php

namespace Controllers;

use User;

class UserController extends Controller
{
    #[Securite('Connected',false)]
    public function login($params) 
    {
        
        //$test=new Securite();
        //$test2=new User();
        /*
       
        */
        
        
        echo $this->twig->render('user/login.html', ["message"=>$params["message"]]); 
    }
    
    
    public function check($params)
    {
        $em = $params['em'];
        $url= $params['url'];
        var_dump($params['post']);
        $login=$params['post']['login'];
        $password=$params['post']['password'];
        //Version simplifiée du controle de mot de passe
        
        //Recherche de l'utilisateur dan sla base de données
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u')
            ->where('u.login = ?1')
            ->setParameter(1,$login )
        ;
        
       
        $query = $qb->getQuery();
        $users= $query->getResult();
        if (sizeof($users)>0 ) {
            $user=$users[0];
            if ($user->getPassword() == $password) {
                $_SESSION['loged']=true;
                $_SESSION['user']=$user;
                header("Location: ".$url."?c=user&t=welcome");
                
                exit;
            }
            else {
                $_SESSION['loged']=false;
                header("Location: ".$url."?c=user&t=login&message=Mot de passe incorrect");
                exit;
                
            }
        }
        else {
            $user=null;
            $_SESSION['loged']=false;
            header("Location: ".$url."?c=user&t=login&message=Cet utilisateur n'existe pas");
            exit;
        }
        
        
    }
    
    public function welcome($params) 
    {
        $user=$_SESSION['user'];
        echo $this->twig->render('user/welcome.html', ["user"=>$user,"params"=>$params]);
    }
    public function one($params)
    {
        //savoir si un utilisateur existe deja
        
        $entityManager=$params["em"];
	    $connectUser="Un seul";
	    
	    $user = new User();
        $user->setNom("TERRAILLON");
        $user->setPrenom("Camille");
        $user->setAvatar(file_get_contents('data:image/jpeg;base64,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'));
        $entityManager->persist($user);
        $entityManager->flush();
        
	    echo $this->twig->render('index.html', ['connectUser' =>   $connectUser,"params"=>$params]);
    }
    
    public function liste($params) {
        
        $connectUser="tous";
        $em=$params["em"];
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u')
        ;
        
        
        $query = $qb->getQuery();
       
        $users = $query->getResult();
        
        echo $this->twig->render('userListe.html', ['connectUser' =>   $connectUser,'users'=>$users]);
        
    }
    #[Route('/blog', name: 'blog_list')]
    public function create($params) {
        
        
        
          
        echo $this->twig->render('user/create.html');
    }
    public function insert($params) {
        
        //$dataStatut = $db->prepare('SELECT ville_nom FROM villes_france_free LIMIT 20');
        //$dataStatut->execute();
        //$villes=$dataStatut->fetchAll();
        echo "INSERT";
    }
    
    
}
