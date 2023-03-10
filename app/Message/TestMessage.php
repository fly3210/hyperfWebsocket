<?php

namespace App\Message;

use App\Annotation\WSController;
use App\Annotation\WSRoute;

#[WSController(prefix: 'test')]
class TestMessage extends BaseMessage
{
    #[WSRoute]
    public function index()
    {
        return $this->success([
            'fd' => $this->frame->fd,
        ], 'success to isun');
    }

    #[WSRoute]
    public function test()
    {
        return [
            'message' => __METHOD__,
        ];
    }
}