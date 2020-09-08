<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\Base;

use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\RequestOptions;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        //http组建服务注入依赖
        $app['http_client'] = function () {
            return new GuzzleHttp([
                RequestOptions::TIMEOUT => 5,
                'verify'=>false
            ]);
        };

        //接口签名验证服务注入依赖
        $app['credential'] = function ($app) {
            return new Credential($app);
        };
    }
}
