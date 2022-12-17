<?php
// +----------------------------------------------------------------------
// | 小程序操作类
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://yunxuankeji.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yx <yx@yunxuankeji.cn>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace Yun\Util\Wechat\Mini;
use Yun\Util\Http\HttpHelper;
use Yun\Util\Wechat\Mini\Crypt\WxBizDataCrypt;
use Yun\Util\Wechat\Mini\Config;


class WeXinMini
{
    protected $AppId = '';//小程序 appId
    protected  $AppSecret ='';//小程序 appSecret
    private $api_url = 'https://api.weixin.qq.com/';

    public function __construct($AppId = '',$AppSecret = '')
    {
        if($AppId)$this->AppId = $AppId;
        if($AppSecret)$this->AppSecret = $AppSecret;
    }

    public function getJscode2session($code='')
    {
        $path = 'sns/jscode2session';
        $param= '?appid='.$this->AppId.'&secret='.$this->AppSecret.'&js_code='.$code.'&grant_type=authorization_code';
        $url = $this->api_url.$path.$param;
        $result=json_decode((new HttpHelper)->curl($url),true);
        return $result;
    }

    
    /**
     * 获取解密后的用户信息
     */
    public function getUserInfo($sessionKey='',$encryptedData='',$iv='')
    {
        $WxBizDataCrypt = new WxBizDataCrypt($this->AppId, $sessionKey);
        $errCode = $WxBizDataCrypt->decryptData($encryptedData, $iv, $data );
        $data = json_decode($data,true);
        return $data;
    }
}
