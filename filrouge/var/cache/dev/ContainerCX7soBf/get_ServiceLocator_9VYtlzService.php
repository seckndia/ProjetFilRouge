<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.9V_Ytlz' shared service.

return $this->privates['.service_locator.9V_Ytlz'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
    'repo' => ['privates', 'App\\Repository\\DepotsRepository', 'getDepotsRepositoryService.php', true],
], [
    'entityManager' => '?',
    'repo' => 'App\\Repository\\DepotsRepository',
]);
