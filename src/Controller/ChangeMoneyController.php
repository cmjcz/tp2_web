<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        //Initialisation du formulaire
        $form = $this->createFormBuilder($transaction)->add('solde', NumberType::class, ['label' => 'Montant'])->add('intitule', TextType::class)->getForm();
        $form->handleRequest($request);
        $transaction->setDate(new DateTime())->setIdCompte($compte);

        if($form->isSubmitted() && $form->isValid()){
            $last = $compte->getLastTransaction();
            //Définition du solde après transaction. Il s'agit du solde actuel (par défaut 0) additionné au montant de la transaction.
            $transaction->setSolde(is_null($last) ? 0 : $last->getSolde() + $transaction->getSolde() * $signe);
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
