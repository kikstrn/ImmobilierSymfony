<?php

namespace App\Controller;

use App\Entity\EauChaude;
use App\Form\EauChaudeType;
use App\Repository\EauChaudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eau/chaude")
 */
class EauChaudeController extends AbstractController
{
    /**
     * @Route("/", name="eau_chaude_index", methods={"GET"})
     */
    public function index(EauChaudeRepository $eauChaudeRepository): Response
    {
        return $this->render('eau_chaude/index.html.twig', [
            'eau_chaudes' => $eauChaudeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="eau_chaude_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $eauChaude = new EauChaude();
        $form = $this->createForm(EauChaudeType::class, $eauChaude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eauChaude);
            $entityManager->flush();

            return $this->redirectToRoute('eau_chaude_index');
        }

        return $this->render('eau_chaude/new.html.twig', [
            'eau_chaude' => $eauChaude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eau_chaude_show", methods={"GET"})
     */
    public function show(EauChaude $eauChaude): Response
    {
        return $this->render('eau_chaude/show.html.twig', [
            'eau_chaude' => $eauChaude,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="eau_chaude_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EauChaude $eauChaude): Response
    {
        $form = $this->createForm(EauChaudeType::class, $eauChaude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eau_chaude_index');
        }

        return $this->render('eau_chaude/edit.html.twig', [
            'eau_chaude' => $eauChaude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eau_chaude_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EauChaude $eauChaude): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eauChaude->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eauChaude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('eau_chaude_index');
    }
}
