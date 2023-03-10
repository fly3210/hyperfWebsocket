<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\WSService;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\WebSocketServer\Constant\Opcode;
use Swoole\Server;
use Swoole\WebSocket\Server as WebSocketServer;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    #[Inject]
    public WSService $WSService;
    public function onMessage($server, $frame): void
    {
        $data = WSService::$router;
        $jsonData = json_decode($frame->data, true);
        if (isset($jsonData['action']) && isset($data[$jsonData['action']])) {
            $class = $data[$jsonData['action']]['class'];
            $method = $data[$jsonData['action']]['method'];
            $class = new $class($frame, $server);
            $res = $class->$method();
            unset($class);
            $server->push($frame->fd, json_encode($res, JSON_UNESCAPED_UNICODE));
        }else {
            $server->push($frame->fd, 'action not found');
        }
        /*if($frame->opcode == Opcode::PING) {
            // 如果使用协程 Server，在判断是 PING 帧后，需要手动处理，返回 PONG 帧。
            // 异步风格 Server，可以直接通过 Swoole 配置处理，详情请见 https://wiki.swoole.com/#/websocket_server?id=open_websocket_ping_frame
            $server->push('', Opcode::PONG);
            return;
        }
        $server->push($frame->fd, 'Recv: ' . $frame->data);*/
    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    public function onOpen($server, $request): void
    {
        $this->WSService->getRouterData();
        $server->push($request->fd, 'Opened');
    }
}