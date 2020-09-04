<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\AliPay;

use Payment\cmbPayClient\Application;
use Payment\cmbPayClient\Base\BaseClient;
use Payment\cmbPayClient\Base\Exceptions\ClientError;

/**
 * 聚合支付 -- 支付宝请求客户端.
 */
class Client extends BaseClient
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * 发起聚合支付通用付款码支付.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function nativeOrderSubmit(array $payInfo)
    {
        $this->setUri('/v1.0/mchorders/zfbqrcode');

        $this->setParams($payInfo);

        return $request = $this->httpPostJson();
    }

    /**
     * 支付宝服务窗支付.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function windowsOrderSubmit(array $payInfo)
    {
        $this->setUri('/v1.0/mchorders/servpay');

        $this->setParams($payInfo);

        return $request = $this->httpPostJson();
    }
}
