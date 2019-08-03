<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjoutcomptControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'cheikh',
            'PHP_AUTH_PW'=>'test'
                 ]);
        $crawler = $client->request('POST', 'api/ajoutcompt',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '
        {
            "solde":0,
            "partenaire":8
        }
        '
    
    
    
    );

    $rep = $client->getResponse();
    var_dump($rep);
    $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}
