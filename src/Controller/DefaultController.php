<?php
namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class DefaultController{
	
    public function index(Environment $twig){
	
        $tableau = ["element1" => 10, "element2" => 20,"element3" => 30];
        
        return new Response(
            $twig->render(
                "page.html.twig", //la vue à afficher
                ["resultat" => $tableau] 
                //les variables et autres données nécessaires à la vue
            )
        );
    }
}