<?php

namespace App\Lib;

interface CallMethodClassesInterface
{
    public static function getClassesByAnnotation(string $annotation) :array;
    public static function getMethodsByAnnotation(string $annotation) :array;
}