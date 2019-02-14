<?php

namespace App\Controller;

use App\Entity\Comptes;
use App\Form\ComptesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comptes")
 */
class ComptesController extends AbstractController
{
    /**
     * @Route("/", name="comptes_index", methods={"GET"})
     */
    public function index(): Response
    {
        $comptes = $this->getDoctrine()
            ->getRepository(Comptes::class)
            ->findAll();

        return $this->render('comptes/index.html.twig', [
            'comptes' => $comptes,
        ]);
    }

    /**
     * @Route("/new", name="comptes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $compte = new Comptes();
        $form = $this->createForm(ComptesType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();

            return $this->redirectToRoute('comptes_index');
        }

        return $this->render('comptes/new.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcomptes}", name="comptes_show", methods={"GET"})
     */
    public function show(Comptes $compte): Response
    {
        return $this->render('comptes/show.html.twig', [
            'compte' => $compte,
        ]);
    }

    /**
     * @Route("/{idcomptes}/edit", name="comptes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comptes $compte): Response
    {
        $form = $this->createForm(ComptesType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comptes_index', [
                'idcomptes' => $compte->getIdcomptes(),
            ]);
        }

        return $this->render('comptes/edit.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcomptes}", name="comptes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comptes $compte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compte->getIdcomptes(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comptes_index');
    }
}
