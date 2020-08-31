<?php
/**
 * This file is part of Terp.
 *
 * @link     http://terp.kkguan.com
 * @license  http://192.168.30.119:10080/KKERP/erp
 */

namespace Payment\cmbPayService;

use Payment\cmbPayClient\Application;
use Payment\cmbPayClient\Base\Exceptions\ClientError;
use Payment\cmbPayClient\Order\Client;

/**
 * 微信支付服务
 */
class WeChatPay
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
     * 取消订单列表.
     *
     * @param  int         $startCancelTime  订单取消审核开始时间，Unix-Time时间戳, 最大时间范围不超过7天
     * @param  int         $endCancelTime    订单取消审核结束时间，Unix-Time时间戳, 最大时间范围不超过7天
     * @param  int         $pageNo           查询当前分页，从1开始计数
     * @param  int         $pageSize         分页大小, 默认50，最大值不超过100
     * @param  string      $logistics        物流模式
     * @param  string      $orderCheckStatus 订单审核状态  当值为"unaudited"时为未审核,当值为"audited"时为已审核
     * @throws ClientError
     */
    public function cancelOrderList(
        int $startCancelTime,
        int $endCancelTime,
        int $pageNo = 1,
        int $pageSize = 50,
        string $logistics = '',
        string $orderCheckStatus = ''
    ): array {
        // //检测状态传值
        if (!empty($orderCheckStatus) && !in_array($orderCheckStatus, ['unaudited', 'audited'])) {
            throw new ClientError('参数值异常', 1000003);
        }

        return  $this->orderClient->cancelOrderList(
            $startCancelTime,
            $endCancelTime,
            $pageNo,
            $pageSize,
            $logistics,
            $orderCheckStatus
        );
    }
}
