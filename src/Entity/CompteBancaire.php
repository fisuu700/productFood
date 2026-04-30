<?php

namespace App\Entity;

use App\Repository\CompteBancaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteBancaireRepository::class)]
class CompteBancaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $proprietaire = null;

    #[ORM\Column]
    private ?float $solde = null;

    // Constructeur pour initialiser l'objet
    public function __construct(string $proprietaire, float $solde)
    {
        $this->proprietaire = $proprietaire;
        $this->solde = $solde;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(string $proprietaire): static
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): static
    {
        $this->solde = $solde;
        return $this;
    }

    /**
     * Méthode pour retirer un montant avec calcul de TVA (5.5%)
     * Retourne la valeur de la TVA calculée.
     */
    public function retirer(float $montant): float
    {
        // Calcul de la TVA (5.5%)
        $tva = $montant * 0.055;
        $totalADebiter = $montant + $tva;

        // Vérification du solde
        if ($totalADebiter > $this->solde) {
            throw new \Exception("Solde insuffisant (Montant + TVA) !");
        }

        // Mise à jour du solde
        $this->solde -= $totalADebiter;

        // Retourner la TVA kima tlabt (ex: 100 -> 5.5)
        return $tva;
    }
}
