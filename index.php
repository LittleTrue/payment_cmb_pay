<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */
require_once __DIR__ . '/vendor/autoload.php';

use Payment\cmbPayClient\Application;
use Payment\cmbPayService\WeChatPayService;

//service与client的依赖注入容器后,将容器示例传入用于初始化服务,准备进行服务调用,加入容器初始化参数
// $ioc_con_app = new Application([
//     'appid'   => 'ff972cf032',
//     'appSecret'=> '7cff8a10032d2a0315847b9db6e8baaf',
//     'base_uri' => 'https://flssandbox.xiaohongshu.com',
// ]);

$ioc_con_app = new Application([
    'appid'    => 'e315a8b5-45f6-4f96-b20a-0b586a2a96c6',
    'secret'   => '6adca97f-c411-43cd-93ed-7f1aee829832',
    'base_uri' => 'http://api-polypay-uat.cmburl.cn/signtest/',
]);

//服务-----
$orderClientSrv = new WeChatPayService($ioc_con_app);

var_dump($order_info = $orderClientSrv->cancelOrderList('1581425139', '1581511540'));
