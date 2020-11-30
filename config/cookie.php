<?php
// +----------------------------------------------------------------------
// | Cookie设置
// +----------------------------------------------------------------------
return [
    // cookie 保存时间
    'expire'    => 0,
    // cookie 保存路径 只有此路径下的页面可读cookie
    'path'      => '/',
    // cookie 有效域名 不允许跨域访问cookie，父域名cookie可由子域名使用，反之不行。
    'domain'    => '',
    // cookie 启用安全传输 是否走https
    'secure'    => false,
    // httponly设置 只有在http请求头中会带cookie，而不能通过document.cookie来访问此cookie
    'httponly'  => false,
];

// domain
// 为可以访问此cookie的域名，顶级域名只能设置domain为顶级域名，不能设置为二级域名或者三级域名，否则cookie无法生成。
// 二级域名能读取设置了domain为顶级域名或者自身的cookie，不能读取其他二级域名domain的cookie。所以要想cookie在多
// 个二级域名中共享，需要设置domain为顶级域名，这样就可以在所有二级域名里面或者到这个cookie的值了。

    // 是否使用 setcookie
    // 'setcookie' => true,
