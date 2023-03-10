<?php

namespace App\Annotation;


use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;
#[Attribute(Attribute::TARGET_METHOD)]
class WSRoute extends AbstractAnnotation
{
    public ?string $path = null;

    /**
     * @param ?string $path 路由前缀
     */
    public function __construct(...$value)
    {
        parent::__construct(...$value);
    }
}