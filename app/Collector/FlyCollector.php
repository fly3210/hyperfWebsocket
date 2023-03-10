<?php

namespace App\Collector;

use Hyperf\Di\Annotation\AnnotationInterface as AnnotationInterfaceAlias;
#[\Attribute(\Attribute::TARGET_ALL)]
class FlyCollector implements AnnotationInterfaceAlias
{
    protected string $prefix;
    public function collectClass(string $className): void
    {
        var_dump($className);
        // TODO: Implement collectClass() method.
    }

    public function collectMethod(string $className, ?string $target): void
    {
        // TODO: Implement collectMethod() method.
    }

    public function collectProperty(string $className, ?string $target): void
    {
        // TODO: Implement collectProperty() method.
    }

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }


}