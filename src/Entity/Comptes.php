<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comptes
 *
 * @ORM\Table(name="Comptes", uniqueConstraints={@ORM\UniqueConstraint(name="nom_UNIQUE", columns={"nom"})})
 * @ORM\Entity
 */
class Comptes
{
    /**
     * @var int
     *
     * @ORM\Column(name="idComptes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomptes;

    /**
     * @var \Transcations
     *
     * @ORM\OneToMany(targetEntity="Transactions", mappedBy="idcompte")
     * @ORM\OrderBy({"date" = "DESC"})
     */
    private $transactions;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    public function __construct(){
        $this->transactions = new ArrayCollection();
    }

    public function getIdcomptes(): ?int
    {
        return $this->idcomptes;
    }

    public function getTransactions(){
        return $this->transactions;
    }

    public function getLastTransaction(){
        return $this->transactions[0];
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function addTransaction(Transactions $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setIdcompte($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getIdcompte() === $this) {
                $transaction->setIdcompte(null);
            }
        }

        return $this;
    }


}
