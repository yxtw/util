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

class Config
{
    public static $AppId = '';//小程序 appId
    public static $AppSecret ='';//小程序 appSecret
    public static $api_url = 'https://api.weixin.qq.com/';

    public function __construct($AppId = '',$AppSecret = '')
    {
        if($AppId) $this->AppId = $AppId;
        if($AppSecret) $this->AppSecret = $AppSecret;
    }


    public static function getAppId()
    {
        return self::$AppId;
    }

}
