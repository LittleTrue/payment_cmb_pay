<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\WeChatPay;

use Payment\cmbPayClient\Application;
use Payment\cmbPayClient\Base\BaseClient;
use Payment\cmbPayClient\Base\Exceptions\ClientError;

/**
 * 聚合支付 -- 微信支付请求客户端.
 */
class Client extends BaseClient
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * 发起微信统一支付下单.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function unifiedOrderSubmit(array $payInfo)
    {
        $this->setUri('/v1.0/mchorders/onlinepay');

        $this->setParams($payInfo);

        return $request = $this->httpPostJson();
    }
}
