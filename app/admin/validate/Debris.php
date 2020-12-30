<?php
/**
 * +----------------------------------------------------------------------
 * | 碎片管理验证器
 * +----------------------------------------------------------------------
 */
namespace app\admin\validate;

use think\Validate;

class Debris extends Validate
{
    protected $rule = [
        'sort|排序' => [
            'require' => 'require',
            'max' => '8',
            'number' => 'number',
        ],
        'status|状态' => [
            'require' => 'require',
            'max' => '1',
        ],
        'title|碎片标题' => [
            'require' => 'require',
            'max' => '255',
        ],
        'name|调用名称' => [
            'require' => 'require',
            'max' => '255',
        ],
        'url|链接地址' => [
            'max' => '255',
        ],
        'description|描述' => [
            'max' => '255',
        ]
    ];
}