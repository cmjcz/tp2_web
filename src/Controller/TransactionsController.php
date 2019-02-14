<?php

namespace App\Controller;

use App\Entity\Transactions;
use App\Form\TransactionsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transactions")
 */
class TransactionsController extends AbstractController
{
    /**
     * @Route("/", name="transactions_index", methods={"GET"})
     */
    public function index(): Response
    {
        $transactions = $this->getDoctrine()
            ->getRepository(Transactions::class)
            ->findAll();

        return $this->render('transactions/index.html.twig', [
            'transactions' => $transactions,
        ]);
    }

    /**
     * @Route("/new", name="transactions_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $transaction = new Transactions();
        $form = $this->createForm(TransactionsType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('transactions_index');
        }

        return $this->render('transactions/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtransactions}", name="transactions_show", methods={"GET"})
     */
    public function show(Transactions $transaction): Response
    {
        return $this->render('transactions/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{idtransactions}/edit", name="transactions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transactions $transaction): Response
    {
        $form = $this->createForm(TransactionsType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transactions_index', [
                'idtransactions' => $transaction->getIdtransactions(),
            ]);
        }

        return $this->render('transactions/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtransactions}", name="transactions_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Transactions $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getIdtransactions(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transactions_index');
    }
}
