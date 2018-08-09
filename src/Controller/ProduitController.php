<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ProduitType;

class ProduitController extends Controller {

    /**
     * @Route("/", name="produits")
     */
    public function index() {

        $repo = $this->getDoctrine()
                ->getRepository(Produit::class);

        $consoles = $repo->findAll();
        
        $form = $this->createForm(ProduitType::class);

        return $this->render('produit/index.html.twig', [
                    "consoles" => $consoles,
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="produit")
     */
    public function afficher($id) {

        $repo = $this->getDoctrine()
                ->getRepository(Produit::class);

        $console = $repo->find($id);

        if (!$console) {

            $this->get('session')->getFlashBag()->add(
                    'Erreur', 'Le produit demandé n\'existe pas'
            );

            return $this->redirectToRoute("produits");
        } else {
            return $this->render('produit/afficher.html.twig', [
                        "console" => $console]);
        }
    }

}
