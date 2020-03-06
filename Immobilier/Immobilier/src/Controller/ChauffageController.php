<?php

namespace App\Controller;

use App\Entity\Chauffage;
use App\Form\ChauffageType;
use App\Repository\ChauffageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chauffage")
 */
class ChauffageController extends AbstractController
{
    /**
     * @Route("/", name="chauffage_index", methods={"GET"})
     */
    public function index(ChauffageRepository $chauffageRepository): Response
    {
        return $this->render('chauffage/index.html.twig', [
            'chauffages' => $chauffageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chauffage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chauffage = new Chauffage();
        $form = $this->createForm(ChauffageType::class, $chauffage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chauffage);
            $entityManager->flush();

            return $this->redirectToRoute('chauffage_index');
        }

        return $this->render('chauffage/new.html.twig', [
            'chauffage' => $chauffage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chauffage_show", methods={"GET"})
     */
    public function show(Chauffage $chauffage): Response
    {
        return $this->render('chauffage/show.html.twig', [
            'chauffage' => $chauffage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chauffage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chauffage $chauffage): Response
    {
        $form = $this->createForm(ChauffageType::class, $chauffage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chauffage_index');
        }

        return $this->render('chauffage/edit.html.twig', [
            'chauffage' => $chauffage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chauffage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chauffage $chauffage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chauffage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chauffage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chauffage_index');
    }
}
