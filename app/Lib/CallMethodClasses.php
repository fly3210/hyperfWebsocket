<?php

namespace App\Lib;

use Hyperf\Di\Annotation\AnnotationCollector;

class CallMethodClasses implements CallMethodClassesInterface
{
    /**
     * 获取所有带有指定注解的类
     * @param string $annotation
     * @return array
     */
    public static function getClassesByAnnotation(string $annotation) :array
    {
        return AnnotationCollector::getClassesByAnnotation($annotation);
    }

    /**
     * 获取所有带有指定注解的方法
     * @param string $annotation
     * @return array
     */
    public static function getMethodsByAnnotation(string $annotation) :array
    {
        return AnnotationCollector::getMethodsByAnnotation($annotation);
    }
}