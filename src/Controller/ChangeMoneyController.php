<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use \DateTime;
use App\Entity\Comptes;
use App\Entity\Transactions;
use App\Entity\Argent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeMoneyController extends AbstractController
{
    /**
     * @Route("/retrait/{compte}", name="retrait")
     */
    public function retrait(Request $request, Comptes $compte) : Response
    {
        return $this->changeMonney($compte, $request, -1, 'Retrait');
    }

    /**
     * @Route("/depot/{compte}", name="depot")
     */
    public function depot(Request $request, Comptes $compte) : Response
    {
        return $this->changeMonney($compte, $request, 1, 'Depot');
    }

    private function changeMonney(Comptes $compte, Request $request, int $signe, String $nom) : Response
    {
        $transaction = new Transactions();
        $sum = new Argent();
        $form = $this->createFormBuilder($sum)->add('somme', NumberType::class)->getForm();
        $form->handleRequest($request);
        $transaction->setDate(new DateTime())->setIdCompte($compte);

        if($form->isSubmitted() && $form->isValid()){
            $transaction->setSolde($compte->getLastTransaction()->getSolde() + $sum->getSomme() * $signe);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaction);
            $entityManager->flush();
            return $this->redirectToRoute('comptes_show', ['idcomptes' => $compte->getIdComptes()]);
        }

        return $this->render('change_money/index.html.twig', [
            'operation' => $nom,
            'form' => $form->createView(),
        ]);
    }
}
