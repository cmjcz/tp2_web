<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * Transactions
 * Représente la transaction localement. Une transaction est un intitulé, une date, et un solde d'arrivé.
 * Son rôle est de conserver l'historique de toutes les transactions.
 *
 * @ORM\Table(name="Transactions", indexes={@ORM\Index(name="fk_Transactions_1_idx", columns={"idCompte"})})
 * @ORM\Entity
 */
class Transactions
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTransactions", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransactions;

    /**
     * @var int
     *
     * @ORM\Column(name="solde", type="integer", nullable=false)
     */
    private $solde = '0';

    /**
     * @var \String
     *
     * @ORM\Column(name="intitule", type="string", nullable=false)
     */
    private $intitule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \Comptes
     *
     * @ORM\ManyToOne(targetEntity="Comptes", inversedBy="transactions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCompte", referencedColumnName="idComptes")
     * })
     */
    private $idcompte;

    public function getIdtransactions(): ?int
    {
        return $this->idtransactions;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function getIntitule(){
        return $this->intitule;
    }

    public function setIntitule($intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDateString(): ?string{
        return $this->date->format("d m Y H-m-s");
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdcompte(): ?Comptes
    {
        return $this->idcompte;
    }

    public function setIdcompte(?Comptes $idcompte): self
    {
        $this->idcompte = $idcompte;

        return $this;
    }


}
