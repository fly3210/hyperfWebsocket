### 使用教程

```php
<?php

namespace App\Message;
use App\Annotation\WSController;
use App\Annotation\WSRoute;

#[WSController(prefix: 'index')]
class IndexMessage extends BaseMessage
{
    #[WSRoute(path: 'sunIndex')]
    public function index()
    {
        // $this->frame 可以自行修改baseMessage类
        return $this->success([
            'fd' => $this->frame->fd,
        ], 'success to isun');
    }

    #[WSRoute]
    public function life()
    {
        return $this->success([
            'fd' => $this->frame->fd,
            'data' => 'life is good'
        ], 'success to isun');
    }

    #[WSRoute]
    public function test()
    {
        return [
            'message' => __METHOD__,
        ];
    }

    #[WSRoute]
    public function fly()
    {
        return [
            'message' => __METHOD__,
            'data' => [
                'qq' => '123456789',
                'email' => 'mqq@qq.com'
            ]
        ];
    }

}
```
### websocket 请求
```json
{"action":"index.fly","data":{"name":"fly"}}
```
```json
{"action":"index.sunIndex","data":{"name":"fly"}}
```