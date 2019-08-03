<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepotControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'khadija',
            'PHP_AUTH_PW'=>'test'
                 ]);        
        $crawler = $client->request('POST', 'api/depot',[],[],
        ['CONTENT_TYPE' => 'application/json'],
      '
      {
        "montant":100000,
        "caissier":2,
        "compt":7

      }
      '
    
    
    );

    $rep = $client->getResponse();
    var_dump($rep);
    $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}
