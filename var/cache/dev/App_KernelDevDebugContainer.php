<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerSgpPYNU\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerSgpPYNU/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerSgpPYNU.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerSgpPYNU\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerSgpPYNU\App_KernelDevDebugContainer([
    'container.build_hash' => 'SgpPYNU',
    'container.build_id' => 'a5d495ff',
    'container.build_time' => 1708815690,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerSgpPYNU');