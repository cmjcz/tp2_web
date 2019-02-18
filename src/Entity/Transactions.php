<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * Transactions
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
