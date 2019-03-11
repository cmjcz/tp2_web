<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comptes;
use App\Entity\Transactions;
use \DateTime;
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
            $compteBD = $this->getDoctrine()->getRepository(Comptes::class)->findOneBy(array('nom' => $compte->getNom()));
            // Register
            if(is_null($compteBD)) {
                return $this->render('login/index.html.twig', [
                    'formConnexion' => $formConnexion->createView(),
                    'errorMessage' => "Ce compte n'existe pas !",
                ]);
            }
            // Login
            else {
                $compte = $compteBD;
            }
            return $this->redirectToRoute('comptes_show', ['idcomptes' => $compte->getIdcomptes()]);
        }

        return $this->render('login/index.html.twig', [
            'formConnexion' => $formConnexion->createView(),
        ]);
    }
    /**
     * @Route("/register", name="register", methods={"GET","POST"})
     */
    public function register(Request $request)
    {
        $compte = new Comptes();
        $formRegister = $this->createFormBuilder($compte)->add('nom', TextType::class)->getForm();
        $formRegister->handleRequest($request);

        if ($formRegister->isSubmitted() && $formRegister->isValid()) {
            $compteBD = $this->getDoctrine()->getRepository(Comptes::class)->findOneBy(array('nom' => $compte->getNom()));
            // Register
            if(is_null($compteBD)) {
                $entityManager = $this->getDoctrine()->getManager();
                // Initialize the first transaction for the compte
                $firstTransaction = new Transactions();
                $firstTransaction->setSolde(0);
                $firstTransaction->setDate(new DateTime());
                $firstTransaction->setIntitule("Création du compte");
                $compte->addTransaction($firstTransaction);

                // Add to the db
                $entityManager->persist($compte);
                $entityManager->persist($firstTransaction);
                $entityManager->flush();
            }
            else {
                return $this->render('login/register.html.twig', [
                    'formRegister' => $formRegister->createView(),
                    'errorMessage' => "Ce compte existe déjà !",
                ]);
            }
            return $this->redirectToRoute('comptes_show', ['idcomptes' => $compte->getIdcomptes()]);
        }

        return $this->render('login/register.html.twig', [
            'formRegister' => $formRegister->createView(),
        ]);
    }
}
