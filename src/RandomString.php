<?php
// +----------------------------------------------------------------------
// | RandomString 生成随机字符串
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://yunxuankeji.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yx <yx@yunxuankeji.cn>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace Yun\Util;

class RandomString
{
    public static $format = "%06d"; //默认6位 不足前面补0

    /**
     * 获取存数字形式的随机数
     *
     * @param   int  $min  [$min description]
     * @param   int  $max  [$max description]
     *
     * @return  [type]     [return description]
     */
    public static function getNumberCode(int $min = 000000,int $max = 999999)
    {
        $code = rand($min,$max);
        $code = sprintf(self::$format,$code);
        return $code;
    }
}
