<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\CombinePay;

use Payment\cmbPayClient\Application;
use Payment\cmbPayClient\Base\BaseClient;
use Payment\cmbPayClient\Base\Exceptions\ClientError;

/**
 * 聚合支付 -- 通用支付请求客户端.
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
    public function barcodePaySubmit(array $payInfo)
    {
        $this->setUri('/v1.0/mchorders/pay');

        $this->setParams($payInfo);

        return $request = $this->httpPostJson();
    }

    /**
     * 通用场景 支付后异步查询结果.
     * @param  $requestInfo 支付信息
     * @throws ClientError
     */
    public function payInquiry(array $requestInfo)
    {
        $this->setUri('/v1.0/mchorders/orderquery');

        $this->setParams($requestInfo);

        return $request = $this->httpPostJson();
    }

    /**
     * 通用场景 支付后进行退款.
     * @throws ClientError
     */
    public function orderRefund(array $refundInfo)
    {
        $this->setUri('/v1.0/mchorders/refund');

        $this->setParams($refundInfo);

        return $request = $this->httpPostJson();
    }

    /**
     * 通用场景 退款后进行退款状态查询.
     * @param  $requestInfo 支付信息
     * @throws ClientError
     */
    public function refundInquiry(array $requestInfo)
    {
        $this->setUri('/v1.0/mchorders/refundquery');

        $this->setParams($requestInfo);

        return $request = $this->httpPostJson();
    }

    /**
     * 通用场景 退款后进行退款状态查询.
     * @param  $requestInfo 支付信息
     * @throws ClientError
     */
    public function cancelOrder(array $requestInfo)
    {
        $this->setUri('/v1.0/mchorders/close');

        $this->setParams($requestInfo);

        return $request = $this->httpPostJson();
    }
}
