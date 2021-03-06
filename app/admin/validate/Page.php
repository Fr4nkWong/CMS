<?php
/**
 * +----------------------------------------------------------------------
 * | 单页模块验证器
 * +----------------------------------------------------------------------
 */
namespace app\admin\validate;

use think\Validate;

class Page extends Validate
{
    protected $rule = [
        'status|状态' => [
            'require' => 'require',
            'max' => '1',
        ],
        'sort|排序' => [
            'require' => 'require',
            'max' => '8',
            'number' => 'number',
        ],
        'cate_id|栏目' => [
            'require' => 'require',
        ],
        'title|标题' => [
            'max' => '255',
        ]
    ];
}