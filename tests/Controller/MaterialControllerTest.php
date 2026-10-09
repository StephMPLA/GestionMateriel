<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MaterialControllerTest extends WebTestCase
{
    public function testCannotInjectStatus(): void
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/materiel/ajouter'
        );

        $form = $crawler
            ->selectButton('Enregistrer le matériel')
            ->form();

        $values = $form->getPhpValues();

        $values['materiel']['name'] = 'PC Test Sécurité';
        $values['materiel']['category'] = 'PC';
        $values['materiel']['purchasePrice'] = '500';
        $values['materiel']['status'] = 'attribué';

        $client->request(
            'POST',
            '/materiel/ajouter',
            $values
        );

        self::assertResponseStatusCodeSame(422);

        self::assertSelectorTextContains(
            'body',
            'This form should not contain extra fields'
        );
    }
}
