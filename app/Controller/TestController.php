<?php

namespace App\Controller;

use App\Annotation\WSController;
use App\Annotation\WSRoute;
use App\Collector\FlyCollector;
use App\Service\WSService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[AutoController(prefix: 'test')]
class TestController extends AbstractController
{
    #[Inject]
    public WSService $wsService;

    #[RequestMapping(path: 'index',methods: ['GET'])]
    public function index()
    {
        $this->wsService->run();
        return [
            'message' => "Hello fly.",
        ];
    }
}