<?php

namespace App\Service;

use App\Annotation\WSAction;
use App\Annotation\WSController;
use App\Annotation\WSRoute;
use App\Lib\CallMethodClasses;

final class WSService
{
    public static array $router = [];
    public function getRouterData()
    {
        if (self::$router) {
            return self::$router;
        }
        $router = $this->getRouter();
        $controller = $this->getController();
//        $action = $this->getAction();

        $classArray = $this->extractNewArray($controller, 'class');
        // 拼接路由
        foreach ($router as $_router)
        {
            $class = $_router['class'];
            $method = $_router['method'];
            $prefix = $this->getClassPrefix($classArray, $class);

            $route = $_router['annotation']->path;
            if (is_null($route)) {
                $route = $_router['method'];
            }


            $fullRoute = $prefix .'.'. $route;
            self::$router[$fullRoute] = [
                'class' => $class,
                'method' => $method
            ];
        }

        // 默认路由 Action 开启则使用
        /*foreach ($action as $_action) {
            $class = $_action['class'];
            $method = $_action['method'];
            $prefix = $this->getClassPrefix($classArray, $class);
            $fullRoute = $prefix . '.' . $method;
            self::$router[$fullRoute] = [
                'class' => $class,
                'method' => $method
            ];
        }*/

        return self::$router;

    }
    private function getClassPrefix(array $classArray,string $class) :string
    {
        $prefix = $classArray[$class]->prefix;
        if (is_null($prefix)) {
            $array = explode('\\', $class);
            $prefix = $this->humpToLine(end($array));
        }
        return $prefix;
    }

    // 驼峰转下划线
    private function humpToLine(string $str) :string
    {
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        },$str);
        if(substr($str,0,1) == '_'){
            $str = substr($str,1,strlen($str)-1);
        }
        return $str;
    }

    private function extractNewArray(array $classArray, string $key) :array
    {
        $newArray = [];
        foreach ($classArray as $key=>$class) {
            $newArray[$key] = $class;
        }
        return $newArray;
    }

    private function getAction() :array
    {
        return CallMethodClasses::getMethodsByAnnotation(WSAction::class);
    }

    private function getController() :array
    {
        return CallMethodClasses::getClassesByAnnotation(WSController::class);
    }

    private function getRouter() :array
    {
        return CallMethodClasses::getMethodsByAnnotation(WSRoute::class);
    }

}