<?php
// tests/MonServiceTest.php

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MonServiceTest extends KernelTestCase
{
    public function testService()
    {
        self::bootKernel();

        // Récupérer le conteneur de services
        $container = self::$container;

        // Récupérer le service à tester
        $monService = $container->get(MonService::class);

        // Effectuer les assertions
        $this->assertInstanceOf(MonService::class, $monService);
        // Autres assertions...
    }
}
