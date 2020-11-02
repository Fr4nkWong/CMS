<?php
namespace app\controller;

use app\BaseController;
use app\model\Member;

use think\facade\Db ;

class DBtest extends BaseController
{
    public function index()
    {
        $member = Db::table('ob_member')->select();
        return  json($member);
    }

    public function getMember()
    {
        $member = Member::select();
        return  json($member);
    }
}
