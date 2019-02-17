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
     * @Route("/{idcomptes}", name="comptes_show", methods={"GET"})
     */
    public function show(Comptes $compte): Response
    {
        return $this->render('comptes/show.html.twig', [
            'compte' => $compte,
        ]);
    }
}
