<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller {

    /**
     * @Route("/", name="produit")
     */
    
    public function index() {

        $repo    = $this->getDoctrine()
                        ->getRepository(Produit::class);
        
        $consoles = $repo->findAll();

        return $this->render('produit/index.html.twig', [
                    "consoles" => $consoles
        ]);
        
    }

}
