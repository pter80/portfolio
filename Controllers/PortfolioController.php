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
        echo $this->twig->render('portfolio.html', ["realisations"=>$realisations,'competences'=>$competences,"params"=>$params]);
    }
}
