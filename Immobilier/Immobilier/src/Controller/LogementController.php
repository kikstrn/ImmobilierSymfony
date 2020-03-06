<?php

namespace App\Controller;

use App\Entity\Logement;

use App\Entity\Media;
use App\Entity\Recherche;
use App\Form\LogementType;
use App\Form\MediaType;
use App\Repository\LogementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/logement")
 */
class LogementController extends AbstractController
{
    /**
     * @Route("/", name="logement_index", methods={"GET", "POST"})
     */
    public function index(Request $request, LogementRepository $logementRepository): Response
    {
        $search = new Recherche();

        $form = $this->createForm(\App\Form\RechercheType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $field= $search->getField();
            $resultat = $logementRepository->findLogement($field);
            return $this->render('logement/index.html.twig', [
                'form' => $form->createView(),
                'logement' => $resultat,

            ]);
        }

        return $this->render('logement/index.html.twig', [
            'form' => $form->createView(),
            'logement' => $logementRepository->findAll(),

        ]);
    }


    /**
     * @Route("/new", name="logement_new", methods={"GET","POST"})
     */
    public function new(Request $request,  LogementRepository $logementRepository): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($logement);
            $entityManager->flush();

            return $this->redirectToRoute('logement_index');
        }

        return $this->render('logement/new.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="logement_show", methods={"GET"})
     */
    public function show(Logement $logement): Response
    {
        return $this->render('logement/show.html.twig', [
            'logement' => $logement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="logement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Logement $logement): Response
    {
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('logement_index');
        }

        return $this->render('logement/edit.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="logement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Logement $logement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($logement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('logement_index');
    }
}
