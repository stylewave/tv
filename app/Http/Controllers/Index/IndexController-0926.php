<?php
 namespace App\Http\Controllers\Index;

 use App\Http\Controllers\Common\CommonController;

use App\Http\Controllers\Common\SystemCotroller;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Core\CoreController;

use Illuminate\Http\Request;

use core\libs\view;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller

{

    private $core; 
    private $common; 
    private $jk; 
    private $fenlei; 
    private $newlist; 
    private $yqlist; 
    private $bannerlist; 
    private $nav;
    private $kamiUrl; 
    public function __construct() { 
        // $this->core = new \App\Http\Controllers\Core\CoreController();
        // $this->common = new \App\Http\Controllers\Common\CommonController();

        $this->core = new CoreController();

        #初始化设置项

        $this->webset = config('webset');
        #初始化系统参数

        $this->system = new SystemCotroller();

        #初始化公共控制器

        $this->common = new CommonController();
    }
    public function index($action='') { 
        // if(Cache::{$_ENV['烇'][0x9]}($_ENV['烇'][0x05b])&&$action==$_ENV['烇'][0x000005a]){
        //     return Cache::{$_ENV['烇'][0x0000a]}($_ENV['烇'][0x05b]);
        //     }
        $dytype = ($this->fenlei)[$_ENV['烇'][0x005c]]; 
        // $ds = $this->core->{$_ENV['烇'][0x00000b]}($_ENV['烇'][0x05d],1);
        // $zy = $this->core->{$_ENV['烇'][0xc]}($_ENV['烇'][0x05d],1);
        // $dm = $this->core->{$_ENV['烇'][0x00d]}($_ENV['烇'][0x05d],1);
        // $dy = $this->core->{$_ENV['烇'][0x00e]}($_ENV['烇'][0x05d],1);
        return view('template.wapian.index',['bannerlist'=>'','dytype'=>$dytype]);
        //return view('wapian.index', ['total' => $total[0]['total']+$cxnum,'used_mem'=>$used_mem,'info'=>$info, 'webset' => $this->webset]);
       
     } 

}
