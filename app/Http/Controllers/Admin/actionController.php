<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Common\WriteConfigController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\CoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class actionController extends Controller
{
    private $config;
    private $common;
    private $core;

    public function __construct()
    {
        #初始化公共控制器
        $this->config = new WriteConfigController();
        $this->common = new CommonController();
        $this->core = new CoreController();
    }

    #网站基本设置
    public function webSet(Request $request)
    {
        $path = CONFIG_PATH . 'webset.php';
        $res = $request->post();
        $res['weblogo'] = $this->upload($request);
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功', 'path' => $res['webdir']]);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }

    }

    #播放接口设置
    public function jkSet(Request $request)
    {
        $path = CONFIG_PATH . 'jkset.php';
        $res = $request->post();
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }
    }
    
    #收费设置
    public function sfSet(Request $request)
    {
        $path = CONFIG_PATH . 'sfset.php';
        $res = $request->post();
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }
    }

    #增加电影
    public function addNewMovie(Request $request)
    {
        $res = $request->post();
        $id = $this->setNum();//获得随机数
        $msg = $this->config->writeDyData($res, $id);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }


    }

    #编辑电影
    public function editMovie(Request $request)
    {
        $res = $request->post();
        $msg = $this->config->writeDyData($res, $res['dyid']);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }

    #删除电影
    public function deleteMovie(Request $request)
    {
        $id = $request->post('dyid');
        $msg = $this->config->writeDyData('', $id, 'delete');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }

    #添加友情连接
    public function addYqlink(Request $request)
    {
        $res = $request->post();
        $id = $this->setNum();//获得随机数
        $msg = $this->config->writeYqLink($res, $id);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }


    }
    #编辑友情链接
    public function editYqList(Request $request)
    {
        $res = $request->post();
        $msg = $this->config->writeYqLink($res, $res['yqid']);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }
    #删除友情链接
    public function deleteYqLink(Request $request)
    {
        $id = $request->post('yqid');
        $msg = $this->config->writeYqLink('', $id, 'delete');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }

    #添加直播
    public function addZb(Request $request)
    {
        $res = $request->post();
        $id = $this->setNum();//获得随机数
        $msg = $this->config->writeZb($res, $id);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }


    }
    #编辑直播
    public function editZb(Request $request)
    {
        $res = $request->post();
        $msg = $this->config->writeZb($res, $res['zbid']);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }
    #删除直播
    public function deleteZb(Request $request)
    {
        $id = $request->post('zbid');
        $msg = $this->config->writeZb('', $id, 'delete');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }

    #添加侵权
    public function addQq(Request $request)
    {
        $res = $request->post();
        $id = $this->setNum();//获得随机数
        $msg = $this->config->writeData($res, $id,'','qqlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }
    }
    #编辑清泉
    public function editQq(Request $request)
    {
        $res = $request->post();
        $msg = $this->config->writeData($res, $res['qqid'],'','qqlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }
    #删除侵权
    public function delQqLink(Request $request)
    {
        $id = $request->post('qqid');
        $msg = $this->config->writeData('', $id, 'delete','qqlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }

    #添加轮播
    public function addBanner(Request $request)
    {
        $res = $request->post();
        $id = $this->setNum();//获得随机数
        $msg = $this->config->writeData($res, $id,'','bannerlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }
    }
    #编辑轮播
    public function editBanner(Request $request)
    {
        $res = $request->post();
        $msg = $this->config->writeData($res, $res['bannerid'],'','bannerlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }
    #删除轮播
    public function delBanner(Request $request)
    {
        $id = $request->post('bannerid');
        $msg = $this->config->writeData('', $id, 'delete','bannerlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }

    #添加导航
    public function addNav(Request $request)
    {
        $res = $request->post();
        $id = $this->setNum();//获得随机数
        $msg = $this->config->writeData($res, $id,'','navlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }
    }
    #编辑导航
    public function editNav(Request $request)
    {
        $res = $request->post();
        $msg = $this->config->writeData($res, $res['navid'],'','navlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }
    #删除导航
    public function delNav(Request $request)
    {
        $id = $request->post('navid');
        $msg = $this->config->writeData('', $id, 'delete','navlist');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }

    #生成短网址
    public function getShortUrl(Request $request)
    {
        $key = '3421048570';
        $url = $request->post('longurl');
        $api = 'http://api.t.sina.com.cn/short_url/shorten.json';
        $request_url = sprintf($api.'?source=%s&url_long=%s', $key, $url);
        $str = $this->common->curl_get_dwz($request_url);
        $short = json_decode($str,true);
        if (!empty($short)) {
            $res = ['status' => 200, 'shorturl' => $short[0]['url_short']];
        } else {
            $res = ['status' => 400];
        }

        return json_encode($res);
    }

    #设置微信信息
    public function setWeiXin(Request $request){
        $path = CONFIG_PATH . 'wxconfig.php';
        $res = $request->post();
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }
    }
    #广告数据
    public function setAd(Request $request){
        $path = CONFIG_PATH . 'adconfig.php';
        $res = $request->post();
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }
    }
    #APP数据
    public function appInfo(Request $request){
        $path = CONFIG_PATH . 'appconfig.php';
        $res = $request->post();
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }
    }

    #上传网站logo
    private function upload(Request $request)
    {
        if (!$request->file('weblogo')) {
            return config('webset.webtemplate').'/images/'.'logo.png';
        }
        $path = $request->file('weblogo')->storeAs(config('webset.webtemplate').'/images', 'logo.png');
        return $path;
    }
    #生成随机id
    private function setNum()
    {
        $str = '';
        for ($i = 0; $i < 10; $i++) {
            $str .= rand(0, 9);
        }

        return time() . $str;
    }

    #刷新缓存
    public function flushCache($action){
        $res = $this->common->flushIndex($action);
        if ($res) {
            echo json_encode(['status' => 200, 'msg' => '刷新成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '刷新失败']);
        }
    }
    #获取尝鲜数据
    public function getCx(Request $request)
    {    $key = $request->post('wd');
         $dizhi = $request->post('dizhi');
        $url = $this->core->getCx($key,$dizhi);
        if(empty($url)){
            $data = ['status'=>400];
            return json_encode($data);
        }
        $res = $this->core->getCxData($url[0]['url']);
        $dyaddr = [];
        foreach ($res as $v){
           $dyaddr[]=$v['dyaddr'];
        }
        $data = $res[0];
        $temp = implode("\r\n",$dyaddr);
        $data['dyaddr'] = $temp;
        $data['status'] = 200;
        return json_encode($data);
    }
    #设置cc防御参数
    public function ccDefense(Request $request){
        $path = CONFIG_PATH . 'ccset.php';
        $arr = $request->post();
        $arr['cc_admin_ip']=explode('#',$arr['cc_admin_ip']);
        $msg = $this->config->writeConfig($arr,$path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }

    }
    
    #添加会员
    public function userAdd(Request $request)
    {
        $res = $request->post();
        
        $data = array();
        $data['username'] = $res['username'];
        $data['password'] = md5($res['password']);
        $data['email'] = $res['email'];
        $data['status'] = $res['status'];
        $data['group'] = $res['group'];
        $data['addtime'] = $res['addtime'];

        switch ($res['group']) {
    		case 2 :
    			$data['viptime'] = time() + 3600 * 24 * 30;
    			break;
    		case 3 :
    			$data['viptime'] = time() + 3600 * 24 * 365;
    			break;
    		case 4 : 
    			$data['viptime'] = time() + 3600 * 24 * 999999;
    			break;
    		default:
    			$data['viptime'] = 0;
    			break;
    	}
        
        $id = $res['username'];
        $msg = $this->config->writeData($data, $id,'','user');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }
    }
    #编辑会员
    public function userEdit(Request $request)
    {
        $res = $request->post();
        $userlist =  $this->common->readData('user');
        $user = $userlist[$res['userid']];
        if ($res['password']) {
        	$user['password'] = md5($res['password']);
        }
        $user['email'] = $res['email'];
        $user['status'] = $res['status'];
        $user['group'] = $res['group'];
        switch ($res['group']) {
    		case 2 :
    			$user['viptime'] = time() + 3600 * 24 * 30;
    			break;
    		case 3 :
    			$user['viptime'] = time() + 3600 * 24 * 365;
    			break;
    		case 4 : 
    			$user['viptime'] = time() + 3600 * 24 * 999999;
    			break;
    		default:
    			$user['viptime'] = 0;
    			break;
    	}
        $msg = $this->config->writeData($user, $res['userid'],'','user');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '编辑成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '编辑失败']);
        }

    }
    #删除会员
    public function userDel(Request $request)
    {
        $id = $request->post('userid');
        $msg = $this->config->writeData('', $id, 'delete','user');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }
    

    #生成卡密
    public function kamiAdd(Request $request)
    {
        $res = $request->post();
        for ($i=0;$i<$res['num'];$i++) {
        	$data = array();
        	$data['username'] = '';
        	$data['createtime'] = date('Y-m-d H:i:s');
        	$data['usetime'] = '';
        	$data['status'] = 0;
        	$data['kami'] = randKey(12);//随机生成卡密
        	$data['type'] = $res['type'];
	        $id = $data['kami'];
	        $msg = $this->config->writeData($data, $id,'','kami');
        }
        
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '增加成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '增加失败']);
        }
    }
    #删除卡密
    public function kamiDel(Request $request)
    {
        $id = $request->post('id');
        $msg = $this->config->writeData('', $id, 'delete','kami');
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '删除成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '删除失败']);
        }
    }
     #删除卡密
    public function kamiDelAllUse(Request $request)
    {
        $list =  $this->common->readData('kami');
        $data = array();
        foreach ($list as $key => $row) {
        	if ($row['status'] == 1) {
        		$msg = $this->config->writeData('', $key, 'delete','kami');
        	}
        }

       echo json_encode(['status' => 200, 'msg' => '删除成功']);

    }
    #提取卡密
//    public function getNotUse(Request $request)
//    {
//        $file = date('Ymd-His').'.txt';
//        $newFile = DATA_PATH.$file;
//        $list =  $this->common->readData('kami');
//        foreach ($list as $key => $row) {
//            if ($row['status'] == 0) {
//                file_put_contents($newFile,$row['kami'].'-',FILE_APPEND);
//            }
//        }
//
////        echo json_encode(['status' => 200, 'msg' => '提取成功']);
//        return response()->download($newFile,$file.'.txt');
//    }

    
    #卡密购买链接设置
    public function kamiUrl(Request $request)
    {
        $path = CONFIG_PATH . 'kamiUrl.php';
        $res = $request->post();
        $msg = $this->config->writeConfig($res, $path);
        if ($msg == 'ok') {
            echo json_encode(['status' => 200, 'msg' => '修改成功']);
        } else {
            echo json_encode(['status' => 400, 'msg' => '修改失败']);
        }
    }
}