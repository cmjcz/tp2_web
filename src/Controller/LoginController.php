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
    public function index(Request $request)
    {

        $compte = new Comptes();
        $form = $this->createFormBuilder($compte)->add('nom', TextType::class)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compte = $this->getDoctrine()->getRepository(Comptes::class)
            ->findOneBy(array('nom' => $compte->getNom()));
            if(!is_null($compte)){
                return $this->redirectToRoute('comptes_show', ['idcomptes' => $compte->getIdcomptes()]);
            }
        }
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
