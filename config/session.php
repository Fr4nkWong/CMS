<?php
// +----------------------------------------------------------------------
// | 会话设置
// +----------------------------------------------------------------------

return [
    // session name
    'name'           => 'WZYSESSID',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file cache redis需要在cache.php中配置
    'type'           => 'file',
    // 存储连接标识 当type设置为cache类型的时候指定存储标识
    'store'          => null,
    // 过期时间
    'expire'         => 996,
    // 前缀
    // 'prefix'      => ‘tp_’
    // 序列化
    // 'serialize'     => ['json_encode', 'json_decode'],
];

// DIY session driver
// think\contract\SessionHandlerInterface
// interface SessionHandlerInterface
// {    // 在调用Session::start()的时候执行，并且只会执行一次
//     public function read(string $sessionId): string; 
//      // 在本地化会话数据的时候执行（调用Session::save()方法），系统会在每次请求结束的时候自动执行
//     public function delete(string $sessionId): bool;
//      // 在销毁会话的时候执行（调用Session::destroy()方法）
//     public function write(string $sessionId, string $data): bool;
// }