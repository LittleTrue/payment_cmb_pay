<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\Base;

use Payment\cmbPayClient\Application;

/**
 * authentication and sign.
 */
class Credential
{
    use MakesHttpRequests;

    /**
     * @var Application
     */
    protected $app;

    /* 商户私钥地址 -- RSA加密, 收到信息时, 使用商户私钥进行解密 。 发送生成数字签名时, 使用私钥进行加密 */
    private $_privateKey;

    /* 招行公钥地址 -- RSA加密, 主动发送时, 使用招行公钥进行加密 。 收到并解析数字签名时, 使用招行公钥进行解密 */
    private $_publicKey;

    private $_encoding = 'UTF-8';

    private $_version = '0.0.1';

    private $_signMethod = '01';

    private $_apiSign;

    private $_sign;

    private $_timeStamp;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->_privateKey = $this->app['config']->get('private_key');
        $this->_publicKey = $this->app['config']->get('public_key');
        $this->_timeStamp = time();
    }

    /**
     * Get request headers finally.
     */
    public function getRequestHeaders()
    {
        $headers = [
            'APPID'       => $this->app['config']->get('appid'),
            'timestamp'   => $this->_timeStamp,
            'Content-Type'=> 'application/json;charset=utf-8',
            'Accept'      => 'application/json',
        ];

        //md5加签
        $this->_apiSign = $this->addMd5($this->_sign);

        $headers['apisign'] = $this->_apiSign;

        return $headers;
    }

    /**
     * Get request params finally.
     */
    public function getRequestParams(array $params)
    {
        $data = [
            'biz_content' => json_encode($params),
            'encoding'    => $this->_encoding,
            'signMethod'  => $this->_signMethod,
            'version'     => $this->_version,
        ];

        //筛选排序
        ksort($data);

        //拼接
        $sign_string = 'biz_content=' . $data['biz_content'] . '&encoding=' . $data['encoding'] . '&' . 'signMethod=' . $data['signMethod'] . '&version=' . $data['version'];

        //调用rsaSign函数进行签名
        $this->_sign = $this->rsaSign($sign_string, $this->_privateKey);

        $requestParams = $data;
        $requestParams['sign'] = $this->_sign;

        return $requestParams;
    }

    /*
     * @param $sign
     * @return string 加签结果
     */
    public function addMd5($sign)
    {
        $data = 'appid=' . $this->app['config']->get('appid')
            . '&secret=' . $this->app['config']->get('secret')
            . '&sign=' . $sign
            . '&timestamp=' . $this->_timeStamp;

        return md5($data);
    }

    /**
     * @function RSA签名函数
     * @param $data
     * @param $private_key
     * @param  string $sign_type
     * @return string sign签名
     */
    private function rsaSign($data, $private_key, $sign_type = 'SHA256')
    {
        if (file_exists($private_key)) {
            $res = openssl_get_privatekey($private_key);
            openssl_sign($data, $sign, $res, $sign_type);
            openssl_free_key($res);
        } else {
            $str = chunk_split($private_key, 64, "\n");
            $private_key = "-----BEGIN RSA PRIVATE KEY-----\n{$str}-----END RSA PRIVATE KEY-----\n";
            openssl_sign($data, $sign, $private_key, $sign_type);
        }
        return base64_encode($sign);
    }
}
