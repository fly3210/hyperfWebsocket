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
        return $this->success(json_decode($this->frame->data, true), 'success to isun');
    }

    #[WSRoute]
    public function test()
    {
        return [
            'message' => __METHOD__,
        ];
    }
}