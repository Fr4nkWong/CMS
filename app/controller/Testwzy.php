<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\Request;
use think\facade\Session;
use think\facade\Cookie;


class Testwzy extends BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
		$this->request = $request; // request对象中读取session
    }

    public function index()
    {   
        if($this->request->isGet()) {
            $usr = Session::get('usr');
            $pwd = Session::get('pwd');
            $is_stored_tip = Cookie::get('usr');    // cookie('usr')
            View::assign('is_stored_tip', $is_stored_tip);
            if(Session::has('usr') && Session::has('pwd')) {    // session('?usr')
                View::assign('usr', $usr);
                return View::fetch('index');
            }
            View::assign('usr', null);
            return View::fetch('index');
            // return View::fetch('login');
        }
    }

    public function login()
    {
        if($this->request->isGet()) {
            return View::fetch('login');
        } else if($this->request->isPost()) {
            $usr = $this->request->param('usr');
            $pwd = $this->request->param('pwd');
            $is_stored = $this->request->param('is_stored');
            $is_stored_tip = '  未选择记住账号';
            Cookie::delete('usr'); // cookie('usr', null)
            if($is_stored == 'on') {
                Cookie::set('usr', $usr);
                $is_stored_tip = '  已记住账号，并保存到cookie';
            }
            Session::set('usr', $usr);  // session('usr', $usr)
            Session::set('pwd', $pwd);
            View::assign('usr', $usr);
            View::assign('is_stored_tip', $is_stored_tip);
            return View::fetch('index');
        }
    }

    public function logout()
    {
        Session::delete('usr'); // session('usr', null)
        Session::delete('pwd'); // Session:clear()
        Cookie::delete('usr');  // cookie('usr', null)
        return redirect('/testwzy/index');
    }

    public function hello($name = 'ThinkPHP6')
    {
        Session::flash('flash', 'frank');
        return 'hello,' . session('flash');
    }

    public function hello1()
    {   
        // Session::flush();
        // Session::clear(); // session(null)
        echo 'flash' . Session::has('flash') . '<br>';
        echo 'usr' . Session::has('usr');
    }
}
