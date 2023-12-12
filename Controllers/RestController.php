<?php

namespace Controllers;

class RestController extends Controller
{
    public function test($params)
    {
        //savoir si un utilisateur existe deja
        $age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

        echo json_encode($age);
        
    }

}
