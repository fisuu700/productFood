<?php

namespace App\Tests\Entity;

use App\Entity\CompteBancaire;
use PHPUnit\Framework\TestCase;

class CompteBancaireTest extends TestCase
{
    public function testRetirerCalculTvaCorrectement(): void
    {
        // Arrange: Compte fih 200 DT
        $compte = new CompteBancaire("Firas", 200.0);

        // Act: Retirer 100 DT (TVA lezem t-koun 5.5)
        $tva = $compte->retirer(100.0);

        // Assert
        // 1. Thabet li rja3lek 5.5
        $this->assertEquals(5.5, $tva);

        // 2. Thabet li l-solde walla 94.5 (200 - 105.5)
        $this->assertEquals(94.5, $compte->getSolde());
    }

    public function testRetirerSoldeInsuffisant(): void
    {
        // Arrange: Compte fih 50 DT
        $compte = new CompteBancaire("Firas", 50.0);

        // Assert: Nestannaw f-Exception
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Solde insuffisant (Montant + TVA) !");

        // Act: Njrbou nejbdou 100 DT (impossible)
        $compte->retirer(100.0);
    }
}
