<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Common\CommonController;
use Closure;

class CheckAuth
{
    private $common;
    public function __construct()
    {
        #初始化公共控制器
        $this->common = new CommonController();
    }
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	print_r($request);exit;
    	$needvip = false;
    	$sfset = config('sfset');
//    	$url = $request->server('REQUEST_URI');
//    	if (stripos($url,'dm') !== false && $sfset['dm']) {
//    		$needvip = true;
//    	} else if (stripos($url,'zy') !== false && $sfset['zy']) {
//    		$needvip = true;
//    	} else if (stripos($url,'tv') !== false && $sfset['tv']) {
//    		$needvip = true;
//    	} else if (stripos($url,'movie') !== false && $sfset['movie']) {
//    		$needvip = true;
//    	} else if (stripos($url,'cx') !== false && $sfset['cx']) {
//    		$needvip = true;
//    	}

		$dylist = $this->common->readData('dydata');
		$dy = $dylist[$play];
		print_r($dy);exit;
    	
    	if ($needvip) {
    		if(!$request->session()->get('username')){
	            return redirect('login.html');
	        }
	        $username = $request->session()->get('username');
	        $userlist = $this->common->readData('user');
    		$userinfo = $userlist[$username];
    		if ($userinfo['status']==1 && $userinfo['group']>1 && $userinfo['viptime'] > time()) {
    			return $next($request);
    		} else {
    			exit("<script>alert('请先充值成为VIP会员！');window.location='/ucenter.html';</script>");
    		}
    	}
    	return $next($request);
    }
}
