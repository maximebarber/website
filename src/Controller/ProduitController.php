<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller {

    /**
     * @Route("/", name="produits")
     */
    public function index(Request $request) {

        $repo = $this->getDoctrine()
                ->getRepository(Produit::class);

        $consoles = $repo->findAll();

        return $this->render('produit/index.html.twig', [
                    "consoles" => $consoles
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

    /**
     * @Route("/ajouter", name="ajouter_produit")
     */
    public function ajouter() {

        $form = $this->createForm(ProduitType::class);
        $form->handleRequest($request);

        //$em = entity manager
        //Ajout form à la BDD
        if ($form->isSubmitted() && $form->isValid()) {

            $em      = $this->getDoctrine()->getEntityManager();
            $produit = $form->getData();
            $em->persist($produit);
            $em->flush();
        }
        return $this->render('produit/index.html.twig', [
                    "form" => $form->createView()
        ]);
    }

}
