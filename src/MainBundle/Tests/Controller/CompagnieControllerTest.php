<?php

namespace RA\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompagnieControllerTest extends WebTestCase
{
    public function testListecompagnie()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/compagnie');
    }

}
