<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjoutpartControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'cheikh',
            'PHP_AUTH_PW'=>'test'
                 ]);
        $crawler = $client->request('POST', 'api/ajoutpart',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "username":"yacine",
            "role":3,
            "password":"test",
            "nom1":"sow",
            "tel":778978910,
            "adresse1":"sébi",
            "photo":"img6",
            "cni":"SN00219856977",
            "nom":"Djibienne",
            "adresse":"dakar",
            "raisonsocial":"sa496",
            "ninea":"MP0369697",
            "solde":0

        }
        '
    
    
    
    
    );

    $rep = $client->getResponse();
    var_dump($rep);
    $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}
