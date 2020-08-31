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
 * 订单服务请求客户端.
 */
class Client extends BaseClient
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
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
        int $pageNo,
        int $pageSize,
        string $logistics,
        string $orderCheckStatus
    ): array {
        $this->setUri('/ark/open_api/v0/packages/canceling/list');

        $this->setUrlParams([
            'logistics'         => $logistics,
            'status'            => $orderCheckStatus,
            'page_no'           => $pageNo,
            'page_size'         => $pageSize,
            'start_time'        => $startCancelTime,
            'end_time'          => $endCancelTime,
        ]);

        $request = $this->httpGet();

        return $request['data'];
    }
}
