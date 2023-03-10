<?php

namespace App\Message;

use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class BaseMessage
{
    protected Frame $frame;
    protected Server $server;

    public function __construct(Frame $frame, Server $server)
    {
        $this->frame = $frame;
        $this->server = $server;
    }

    protected function success($data = [], $msg = 'success', $code = 200)
    {
        return [
            'code' => $code,
            'fd' => $this->frame->fd,
            'msg' => $msg,
            'data' => $data,
            'time' => time()
        ];
    }

    protected function error(array $data = [], string $msg = 'error', int $code = 500)
    {
        return [
            'code' => $code,
            'fd' => $this->frame->fd,
            'msg' => $msg,
            'data' => $data,
            'time' => time()
        ];
    }

}