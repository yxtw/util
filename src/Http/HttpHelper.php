<?php
// +----------------------------------------------------------------------
// | Http操作类
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://yunxuankeji.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yx <yx@yunxuankeji.cn>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace Yun\Util\Http;

class HttpHelper
{
    public $headers = [];//头部信息
    public $method = 'POST';//提交类型

    /**
     * post提交
     */
    public function curl($url,$data=[]){
        //启动一个CURL会话
        $curl  = curl_init();
        curl_setopt($curl , CURLOPT_URL,$url);
        if($this->headers)
        {
            array_unshift($this->headers,'Content-Type: application/x-www-form-urlencoded');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        }
        // 设置curl允许执行的最长秒数
        curl_setopt($curl , CURLOPT_TIMEOUT, 120);
        // 获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl , CURLOPT_RETURNTRANSFER,true);
        //发送一个常规的POST请求。
        if($data && $this->method=='POST')
        {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method);
            curl_setopt($curl , CURLOPT_POST, 1);
            curl_setopt($curl , CURLOPT_POSTFIELDS,http_build_query($data));
        }
        curl_setopt($curl , CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl , CURLOPT_HEADER,0);//是否需要头部信息（否）

        if (1 == strpos("$".$url, "https://"))
        {
            //忽略证书
            curl_setopt($curl ,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curl ,CURLOPT_SSL_VERIFYHOST,false);
        }
        // 执行操作
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl);
        return $result;

    }

    
    /**
     * 获取头部信息
     *
     * @return  [type]  [return description]
     */
    public static function getClientHeaders() 
    {
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
    /**
     * 获取客户端ip
     *
     * @return  [type]  [return description]
     */
    public static function getIp() {
        //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
        return $res;
        //dump(phpinfo());//所有PHP配置信息
    }


    /**
     * 获取服务器端IP地址
     *
     * @return  [type]  [return description]
     */
    public static function getServerIp(){
        if(isset($_SERVER)){
            if(isset($_SERVER['REMOTE_ADDR'])){
                $server_ip=$_SERVER['REMOTE_ADDR'];
            }
            elseif(isset($_SERVER['SERVER_ADDR'])){
                $server_ip=$_SERVER['SERVER_ADDR'];
            }
            else{
                $server_ip=$_SERVER['LOCAL_ADDR'];
            }
        }else{
            $server_ip = getenv('SERVER_ADDR');
        }
        return $server_ip;
    }
    /**
     * 获取设备操作系统 ios/android/windows phone
     *
     * @return  [type]  [return description]
     */
    public static function getClientOs() {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(strpos($agent, 'windows nt')) {
            $platform = 'windows';
        } elseif(strpos($agent, 'windows phone')) {
            $platform = 'windows phone';
        } elseif(strpos($agent, 'macintosh')) {
            $platform = 'mac';
        } elseif(strpos($agent, 'ipod')) {
            $platform = 'ipod';
        } elseif(strpos($agent, 'ipad')) {
            $platform = 'ipad';
        } elseif(strpos($agent, 'iphone')) {
            $platform = 'iphone';
        } elseif (strpos($agent, 'android')) {
            $platform = 'android';
        } elseif(strpos($agent, 'unix')) {
            $platform = 'unix';
        } elseif(strpos($agent, 'linux')) {
            $platform = 'linux';
        } else {
            $platform = 'other';
        }
    
        return $platform;
    }
}
