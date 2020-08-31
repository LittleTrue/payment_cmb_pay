<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\Base;

use GuzzleHttp\Psr7\Response;
use Payment\cmbPayClient\Base\Exceptions\ClientError;

/**
 * Trait MakesHttpRequests.
 */
trait MakesHttpRequests
{
    /**
     * @var bool
     */
    protected $transform = true;

    /**
     * @var string
     */
    protected $baseUri = '';

    /**
     * @throws ClientError
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        $uri = $this->baseUri . $uri;
        $response = $this->app['http_client']->request($method, $uri, $options);

        return $this->transform ? $this->transformResponse($response) : $response;
    }

    /**
     * @throws ClientError
     */
    protected function transformResponse(Response $response): array
    {
        if (200 != $response->getStatusCode()) {
            throw new ClientError(
                "接口连接异常，异常码：{$response->getStatusCode()}，请联系管理员",
                $response->getStatusCode()
            );
        }

        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['error_code']) && 0 !== $result['error_code']) {
            throw new ClientError($result['error_msg'], $result['error_code']);
        }

        return $result;
    }
}
