<?php

namespace Controllers;

use Realisations;

class PortfolioController extends Controller
{
    #[Role('Anonym')]
    public function display($params)
    {
        $em=$params['em'];
        $qb = $em->createQueryBuilder();
        $qb->select('r')
            ->from('Realisation', 'r')
            //->join('Localisation', 'l')
            ->leftJoin('r.localisation', 'l')
            //->leftJoin('Localisation','l',\Doctrine\ORM\Query\Expr\Join::WITH,'r.localisation = l.id')
            ->orderBy('l.id') 
        ;
        //var_dump($qb->getQuery()->getSql());
        $query = $qb->getQuery();
        $realisations= $query->getResult();
        
        $qb = $em->createQueryBuilder();
        $qb->select('c')
            ->from('Competence', 'c')
            ->orderBy('c.ordre')
        ;
        $query = $qb->getQuery();
        $competences= $query->getResult();
        
        
        //var_dump($realisations[0]->getCompetences()[0]);
        //echo $this->twig->render('portfolio/display.html', ["realisations"=>$realisations,'competences'=>$competences,"params"=>$params]);
        echo $this->twig->render('portfolio/display.html', ["realisations"=>$realisations,'competences'=>$competences,"params"=>$params]);
    }
    
    #[Role('Anonym')]
    public function addNewCompetence($params) {
        $em=$params['em'];
        $qb = $em->createQueryBuilder();
        $qb->select('r')
            ->from('Realisation', 'r')
            //->join('Localisation', 'l')
            ->leftJoin('r.localisation', 'l')
            //->leftJoin('Localisation','l',\Doctrine\ORM\Query\Expr\Join::WITH,'r.localisation = l.id')
            ->orderBy('l.id') 
        ;
        //var_dump($qb->getQuery()->getSql());
        $query = $qb->getQuery();
        $realisations= $query->getResult();
        
        $qb = $em->createQueryBuilder();
        $qb->select('c')
            ->from('Competence', 'c')
            ->orderBy('c.ordre')
        ;
        $query = $qb->getQuery();
        $competences= $query->getResult();
        echo $this->twig->render('portfolio/insert.html', ["realisations"=>$realisations,'competences'=>$competences,"params"=>$params]);
    }
   
    /*
        Cette fonction permet d'ajouter une compétence à une réalisation et est utilisé lors d'un appel AJAX
    */
    #[Role('Anonym')] 
    public function insertNewCompetence($params) {
        //var_dump($params['post']["real"],$params['post']["comp"]);
        $em = $params['em'];
        $competence = $em->find("Competence",$params['post']["comp"]);
        $realisation = $em->find("Realisation",$params['post']["real"]);
        $realisation->addCompetence($competence);
        $em->persist($realisation);
        $em->flush();
        echo json_encode(array('result'=>'OK',"real_id"=>$realisation->getId(),"comp_id"=>$competence->getId()));
    }
    /*
        Cette fonction permet de supprimer une compétence à une réalisation et est utilisé lors d'un appel AJAX
    */
    #[Role('Anonym')] 
    public function deleteNewCompetence($params) {
        //var_dump($params['post']["real"],$params['post']["comp"]);
        $em = $params['em'];
        $competence = $em->find("Competence",$params['post']["comp"]);
        $realisation = $em->find("Realisation",$params['post']["real"]);
        $realisation->removeCompetence($competence);
        $em->persist($realisation);
        $em->flush();
        echo json_encode(array('result'=>'DELETE OK',"real_id"=>$realisation->getId(),"comp_id"=>$competence->getId()));
    }
    
    #[Role('Anonym')] 
    public function updateNewCompetence($params) {
        //var_dump($params['post']);
        $em = $params['em'];
        $competenceToDel = $em->find("Competence",$params['post']["comp"]);
        $realisation = $em->find("Realisation",$params['post']["real"]);
        $result="Insert";
        
        $deSynth=false;
        $competences=$realisation->getCompetences();
        
        foreach($competences as $competence) {
            if ($competence->getId()==$params['post']['comp']) {
                $deSynth=true;
                
            }
        }
        if ($deSynth) {
            $realisation->removeCompetence($competenceToDel);
            $result="delete";
        }
        else {
            $realisation->addCompetence($competenceToDel);       
        }
        $em->persist($realisation);
        $em->flush();
        echo json_encode(array('result'=>$result,"real_id"=>$realisation->getId(),"comp_id"=>$competence->getId()));
    }
}
