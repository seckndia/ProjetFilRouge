<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'property_accessor' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/property-access/PropertyAccessorInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/property-access/PropertyAccessor.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/ArrayTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/ArrayAdapter.php';

return $this->privates['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false, ($this->privates['cache.property_access'] ?? ($this->privates['cache.property_access'] = new \Symfony\Component\Cache\Adapter\ArrayAdapter(0, false))), true);
