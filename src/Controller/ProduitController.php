<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller {

    /**
     * @Route("/", name="produit")
     */
    public function index() {

        $console = [
            "nom"   => "Nintendo Switch",
            "prix"  => 299.90,
            "image" => "switch.jpg",
        ];

        return $this->render('produit/index.html.twig', [
            "console" => $console
        ]);
    }

}
