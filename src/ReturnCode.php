<?php
// +----------------------------------------------------------------------
// | Utiliy
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://yunxuankeji.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: tw <tw@pstear.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace Yx\Util;

class ReturnCode
{
    const SUCCESS = '0';//正常
    const FAIL = '1';//异常
    const FAILED = '-1';//未登录
    const NOT_REAL = '-2';//未实名
}
