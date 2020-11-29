<?php
// +----------------------------------------------------------------------
// | 会话设置
// +----------------------------------------------------------------------

return [
    // session name
    'name'           => 'WZYSESSID',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file cache  redis需要在cache.php中配置
    'type'           => 'file',
    // 存储连接标识 当type设置为cache类型的时候指定存储标识 redis
    'store'          => null,
    // 过期时间
    'expire'         => 996,
    // 前缀
    // 'prefix'      => ‘tp_’
    // 序列化
    // 'serialize'     => ['json_encode', 'json_decode'],
];