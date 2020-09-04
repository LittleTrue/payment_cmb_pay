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
 * 集合支付 -- 通用服务
 */
class CombinePayService
{
    /**
     * @var Client
     */
    private $combinePayClient;

    public function __construct(Application $app)
    {
        $this->combinePayClient = $app['combine_pay'];
    }

    /**
     * 通用场景 付款码支付.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function barcodePaySubmit(array $payInfo)
    {
        if (empty($payInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return  $this->combinePayClient->barcodePaySubmit($payInfo);
    }

    /**
     * 通用场景 支付后异步查询结果.
     * @param  $requestInfo 查询信息
     * @throws ClientError
     */
    public function payInquiry(array $requestInfo)
    {
        if (empty($requestInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return  $this->combinePayClient->payInquiry($requestInfo);
    }

    /**
     * 通用场景 支付后进行退款.
     * @param  $refundInfo 退款单信息
     * @throws ClientError
     */
    public function orderRefund(array $refundInfo)
    {
        if (empty($refundInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return  $this->combinePayClient->orderRefund($refundInfo);
    }

    /**
     * 通用场景 退款后进行退款状态查询.
     * @param  $requestInfo 查询信息
     * @throws ClientError
     */
    public function refundInquiry(array $requestInfo)
    {
        if (empty($requestInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return  $this->combinePayClient->refundInquiry($requestInfo);
    }
}
