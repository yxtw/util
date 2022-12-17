<?php
namespace Yun\Util;

class ReturnCommon
{
    protected $debug = [];

    /**
     * 构造方法
     * @access public
     */
    public function __construct($debug=[],$app_debug=false)
    {
        $this->debug = $debug;
        $this->app_debug = $app_debug;
    }
    /**
     * 成功
     */
    public function buildSuccess($data = [], $msg = '成功', $code = ReturnCode::SUCCESS, $json_code = 200, $header = [], $options = []) {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
        if ($this->debug && $this->app_debug=='true') {
            $return['debug'] = $this->debug;
        }
        
        $return=json_encode($return,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        // $return=json($return, $json_code, $header, $options);
        return $return;
    }

    /**
     * 失败
     */
    public function buildFailed($code = ReturnCode::FAIL, $msg = '失败', $data = [], $json_code = 200, $header = [], $options = []) {
        return self::buildSuccess($data,$msg,$code, $json_code, $header, $options);
    }
    protected function debug($data) {
        if ($data) {
            $this->debug[] = $data;
        }
    }
}
