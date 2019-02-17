<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comptes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="login", methods={"GET","POST"})
     */
    public function login(Request $request)
    {
        $compte = new Comptes();

        $formConnexion = $this->createFormBuilder($compte)->add('nom', TextType::class)->getForm();
        $formConnexion->handleRequest($request);

        if ($formConnexion->isSubmitted() && $formConnexion->isValid()) {
            $compteBD = $this->getDoctrine()->getRepository(Comptes::class)
            ->findOneBy(array('nom' => $compte->getNom()));
            if(is_null($compteBD)){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($compte);
                $entityManager->flush();
            }
            return $this->redirectToRoute('comptes_show', ['idcomptes' => $compte->getIdcomptes()]);
        }

        return $this->render('login/index.html.twig', [
            'formConnexion' => $formConnexion->createView(),
        ]);
    }
}
