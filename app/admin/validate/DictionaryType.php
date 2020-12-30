<?php
/**
 * +----------------------------------------------------------------------
 * | 字典类型验证器
 * +----------------------------------------------------------------------
 */
namespace app\admin\validate;

use think\Validate;

class DictionaryType extends Validate
{
    protected $rule = [
        'dict_name|字典名称' => [
            'require' => 'require',
            'max' => '100',
        ],
        'status|状态' => [
            'require' => 'require',
        ],
        'remark|备注' => [
            'max' => '200',
        ],
        'sort|排序' => [
            'require' => 'require',
            'max' => '5',
            'number' => 'number',
        ]
    ];
}