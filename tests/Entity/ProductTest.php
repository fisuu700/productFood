<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ProductTest extends TestCase {

    #[DataProvider('foodProvider')]
    public function testFood($prix, $expectedTva) {
        // Na3tiw ism 'test' par défaut khater l-constructeur mte3ek fih 3 paramètres
        $p = new Product('test', 'food', $prix);

        $tva = $p->computeTVA();

        $this->assertSame($expectedTva, $tva);
    }

    public static function foodProvider(): array {
        return [
            'cas 10dt'  => [10, 0.5],
            'cas 20dt'  => [20, 1.0],
            'cas 100dt' => [100, 5.0],
        ];
    }

    public function testOther() {
        $p = new Product('test', 'other', 10);
        $tva = $p->computeTVA();
        $this->assertSame(1.96, $tva);
    }

    public function testInvalidPrice() {
        $p = new Product('test', 'y', -5);
        $this->expectException(\Exception::class);
        $p->computeTVA();
    }
}
