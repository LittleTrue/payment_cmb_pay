<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayService;

use Payment\cmbPayClient\Application;
use Payment\cmbPayClient\Base\Exceptions\ClientError;
use Payment\cmbPayClient\Order\Client;

/**
 * 集合支付 -- 支付宝支付服务
 */
class AliPayService
{
    /**
     * @var Client
     */
    private $aliPayClient;

    public function __construct(Application $app)
    {
        $this->aliPayClient = $app['ali_pay'];
    }

    /**
     * 发起支付宝native支付.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function nativeOrderSubmit(array $payInfo)
    {
        if (empty($payInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return  $this->aliPayClient->nativeOrderSubmit($payInfo);
    }

    /**
     * 发起支付宝服务窗支付.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function windowsOrderSubmit(array $payInfo)
    {
        if (empty($payInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return  $this->aliPayClient->windowsOrderSubmit($payInfo);
    }
}
