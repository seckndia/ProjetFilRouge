<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjoutpartuserControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'dija',
            'PHP_AUTH_PW'=>'test'
                 ]);      
       $crawler = $client->request('POST', 'api/ajoutpartuser',[],[],
       ['CONTENT_TYPE' => 'application/json'],
    '
    {
     "username":"yaya",
    "role":4,
"password":"test",
"nom1":"ly",
"tel":784485692,
"adresse1":"parcelles",
"photo":"img7",
"cni":"SN00219991935",
"partenaire":8,
"compt":5
    }
    '
    
    
    
    );
       
       
       
       
       
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}
