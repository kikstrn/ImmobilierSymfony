<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Entity\Logement;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function index(Request $request, LogementRepository $logementRepository):Response
    {
        $search = new Recherche();

        $form = $this->createForm(\App\Form\RechercheType::class, $search);
        $form->handleRequest($request);
        $field= $search->getField();

        $resultat = $logementRepository->findLogement($field);

        return $this->render('recherche/index.html.twig', [
            'controller_name' => 'RechercheController',
            'form' => $form->createView(),
            'listLogement' => $resultat,
        ]);
    }
}
