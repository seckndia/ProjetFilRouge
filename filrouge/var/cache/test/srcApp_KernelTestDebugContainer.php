<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container1UgQsxd\srcApp_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container1UgQsxd/srcApp_KernelTestDebugContainer.php') {
    touch(__DIR__.'/Container1UgQsxd.legacy');

    return;
}

if (!\class_exists(srcApp_KernelTestDebugContainer::class, false)) {
    \class_alias(\Container1UgQsxd\srcApp_KernelTestDebugContainer::class, srcApp_KernelTestDebugContainer::class, false);
}

return new \Container1UgQsxd\srcApp_KernelTestDebugContainer([
    'container.build_hash' => '1UgQsxd',
    'container.build_id' => 'd5a1d717',
    'container.build_time' => 1564844211,
], __DIR__.\DIRECTORY_SEPARATOR.'Container1UgQsxd');
