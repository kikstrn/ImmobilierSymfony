<?php

namespace App\Controller;

use App\Entity\TypeLogement;
use App\Form\TypeLogementType;
use App\Repository\TypeLogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/logement")
 */
class TypeLogementController extends AbstractController
{
    /**
     * @Route("/", name="type_logement_index", methods={"GET"})
     */
    public function index(TypeLogementRepository $typeLogementRepository): Response
    {
        return $this->render('type_logement/index.html.twig', [
            'type_logements' => $typeLogementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_logement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeLogement = new TypeLogement();
        $form = $this->createForm(TypeLogementType::class, $typeLogement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeLogement);
            $entityManager->flush();

            return $this->redirectToRoute('type_logement_index');
        }

        return $this->render('type_logement/new.html.twig', [
            'type_logement' => $typeLogement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_logement_show", methods={"GET"})
     */
    public function show(TypeLogement $typeLogement): Response
    {
        return $this->render('type_logement/show.html.twig', [
            'type_logement' => $typeLogement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_logement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeLogement $typeLogement): Response
    {
        $form = $this->createForm(TypeLogementType::class, $typeLogement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_logement_index');
        }

        return $this->render('type_logement/edit.html.twig', [
            'type_logement' => $typeLogement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_logement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeLogement $typeLogement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeLogement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeLogement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_logement_index');
    }
}
