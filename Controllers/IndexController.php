<?php

namespace Controllers;

class IndexController extends Controller
{
    public function index()
    {
        //savoir si un utilisateur existe deja
	$connectUser="Philippe";
    echo $this->twig->render('index.html', ['connectUser' => $connectUser]);
    }
    
    
}
