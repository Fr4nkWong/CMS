<?php
/**
 * +----------------------------------------------------------------------
 * | 用户中心控制器
 * +----------------------------------------------------------------------
 */
namespace app\api\controller;


use app\api\service\JwtAuth;
use app\common\model\Users;
use think\facade\Db;
use think\facade\Request;

class User extends Base
{
    /**
     * 控制器中间件 [登录、注册 不需要鉴权]
     * @var array
     */
    protected $middleware = [
        'app\api\middleware\Api' => ['except' => ['login', 'register']],
    ];

    public function login(string $username, string $password)
    {
        // 校验用户名密码
        $user = Users::where('email|mobile', $username)
            ->where('password', md5($password))
            ->find();
        if (empty($user)) {
            $this->result([], 0, '帐号或密码错误');
        } else {
            if ($user['status'] == 1) {
                //获取jwt的句柄
                $jwtAuth = JwtAuth::getInstance();
                $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                //更新信息
                Users::where('id', $user['id'])
                    ->update(['last_login_time' => time(), 'last_login_ip' => Request::ip()]);
                $this->result(['token' => $token], 1, '登录成功');
            } else {
                $this->result([], 0, '用户已被禁用');
            }
        }
    }


    public function register(string $email, string $password){
        // 密码长度不能低于6位
        if (strlen($password) < 6) {
            $this->result([], 0, '密码长度不能低于6位');
        }

        // 邮箱合法性判断
        if (!is_email($email)) {
            $this->result([], 0, '邮箱格式错误');
        }

        // 防止重复
        $id = Db::name('users')->where('email|mobile', '=', $email)->find();
        if ($id) {
            $this->result([], 0, '邮箱已被注册');
        }

        // 注册入库
        $data = [];
        $data['email']           = $email;
        $data['password']        = md5($password);
        $data['last_login_time'] = $data['create_time'] = time();
        $data['create_ip']       = $data['last_login_ip'] = Request::ip();
        $data['status']          = 1;
        $data['type_id']         = 1;
        $data['sex']             = Request::post('sex') ? Request::post('sex') : 0;
        $id = Db::name('users')->insertGetId($data);
        if ($id) {
            $this->result([], 1, '注册成功');
        } else {
            $this->result([], 0, '注册失败');
        }
    }


    public function index()
    {
        $user = Db::name('users')
            ->alias('u')
            ->leftJoin('users_type ut', 'u.type_id = ut.id')
            ->field('u.*,ut.name as type_name')
            ->where('u.id', $this->getUid())
            ->find();
        return $this->result($user, 1, '');
    }


    public function editPwd(string $oldPassword, string $newPassword){
        // 密码长度不能低于6位
        if (strlen($newPassword) < 6) {
            $this->result([], 0, '密码长度不能低于6位');
        }

        // 查看原密码是否正确
        $user = Users::where('id', $this->getUid())
            ->where('password', md5($oldPassword))
            ->find();
        if (!$user) {
            $this->result([], 0, '原密码输入有误');
        }

        //更新信息
        $user = Users::find($this->getUid());
        $user->password = md5($newPassword);
        $user->save();
        $this->result([], 1, '密码修改成功');
    }


    public function editInfo(){
        $data['sex']    = trim(Request::param("sex"));
        $data['qq']     = trim(Request::param("qq"));
        $data['mobile'] = trim(Request::param("mobile"));
        if ($data['mobile']) {
            // 不可和其他用户的一致
            $id = Users::
                where('mobile', $data['mobile'])
                ->where('id', '<>', $this->getUid())
                ->find();
            if ($id) {
                $this->result([], 0, '手机号已存在');
            }
        }
        // 更新信息
        Users::where('id', $this->getUid())
            ->update($data);
        $this->result([], 0, '修改成功');
    }

    /**
     * 获取用户id
     * @return mixed
     */
    protected function getUid(){
        $jwtAuth = JwtAuth::getInstance();
        return $jwtAuth->getUid();
    }
}
