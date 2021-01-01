<?php

namespace mengsen\dingdanxia;

use mengsen\dingdanxia\Util;

class TopClient
{
    public $appkey;
    public $secretKey;
    public $gatewayUrl = "http://api.tbk.dingdanxia.com";
    public $format = "json";
    public $connectTimeout;
    public $readTimeout;
    protected $signMethod = "md5";

    public function __construct($appkey = "", $secretKey = "")
    {
        $this->appkey = $appkey;
        $this->secretKey = $secretKey;
    }

    public function getAppkey()
    {
        return $this->appkey;
    }

    public function setGatewayUrl($gatewayUrl)
    {
        $this->gatewayUrl = $gatewayUrl;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    // 请求
    public function execute($url, $param)
    {

        $param["apikey"] = $this->appkey;
        // $param["timestamp"] = date('Y-m-d H:i:s');
        // $param['method'] = $url;

        //生成签名
        // $sign = Util::createSign($param, $this->secretKey);
        $strParam = Util::createStrParam($param);

        // $strParam .= 'sign=' . $sign;
        $url = $this->gatewayUrl . $url . '?' . $strParam;

        // echo $url;

        $result = file_get_contents($url);
        $result = json_decode($result, true);

        return $result;
    }
}
