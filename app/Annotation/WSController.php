<?php

namespace App\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS)]
class WSController extends AbstractAnnotation
{
    public ?string $prefix = null;


    /**
     * @param ?string $prefix 路由前缀
     */
    public function __construct(...$value)
    {
        parent::__construct(...$value);
    }
}