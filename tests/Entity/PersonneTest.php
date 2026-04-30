<?php

namespace App\Tests\Entity;

use App\Entity\Personne;
use PHPUnit\Framework\TestCase;

class PersonneTest extends TestCase{
    public function testMajeur(){
        $p=new Personne('Firas', 'By', 22);
        $this->assertEquals('majeur', $p->categorie());

    }
    public function testMineur(){
        $p=new Personne('Amine', 'Hajji', 17);
        $this->assertEquals('mineur', $p->categorie());
    }

    public function testInvalideAge(){
        $p=new Personne('Mohamed', 'Ali', -5);
        $this->expectException('\Exception');
        $p->categorie();
    }
}
?>
