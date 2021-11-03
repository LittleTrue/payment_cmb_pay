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
 * 集合支付 -- 微信支付服务
 */
class WeChatPayService
{
    /**
     * @var Client
     */
    private $wechatPayClient;

    public function __construct(Application $app)
    {
        $this->wechatPayClient = $app['wechat_pay'];
    }

    /**
     * 发起微信统一支付下单.
     * @param  $payInfo 支付信息
     * @throws ClientError
     */
    public function unifiedOrderSubmit(array $payInfo)
    {
        if (empty($payInfo)) {
            throw new ClientError('请求参数丢失。');
        }

        return $this->wechatPayClient->unifiedOrderSubmit($payInfo);
    }
}
