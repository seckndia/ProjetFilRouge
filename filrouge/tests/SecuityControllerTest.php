<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecuityControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'cheikh',
            'PHP_AUTH_PW'=>'test'
                 ]);
        $crawler = $client->request('POST', 'api/register',[],[],
         ['CONTENT_TYPE' => 'application/json'],
        '
        {
            "username":"Léna",
            "role":2,
        "password":"test",
        "nom":"ndiongue",
        "tel":778963215,
        "adresse":"mermoze",
        "photo":"img4",
        "cni":"SN0021999166" 
        }
        '

        );
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}
