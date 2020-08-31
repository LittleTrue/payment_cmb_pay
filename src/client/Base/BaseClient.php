<?php
/**
 * This file is part of DEZHI.
 *
 * @department : Commercial development.
 * @description : This file is part of [purchase].
 * DEZHI all rights reserved.
 */

namespace Payment\cmbPayClient\Base;

use GuzzleHttp\RequestOptions;
use Payment\cmbPayClient\Application;
use Payment\cmbPayClient\Base\Exceptions\ClientError;

/**
 * base function.
 */
class BaseClient
{
    use MakesHttpRequests;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $uri = '';

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->baseUri = $this->app['config']->get('base_uri');
    }

    /**
     * Set params.
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Set uri.
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * Make a patch request.
     *
     * @throws ClientError
     */
    public function httpPatchJson(): array
    {
        return $this->requestPatch();
    }

    /**
     * Make a Put request.
     *
     * @throws ClientError
     */
    public function httpPutJson(): array
    {
        return $this->requestPut();
    }

    /**
     * Make a post request.
     *
     * @throws ClientError
     */
    public function httpPostJson(): array
    {
        return $this->requestPost();
    }

    /**
     * Make a get request.
     * @throws ClientError
     */
    public function httpGet(): array
    {
        return $this->requestGet();
    }

    /**
     * @throws ClientError
     */
    protected function requestPatch(): array
    {
        $options[RequestOptions::JSON] = $this->app['credential']->getRequestParams($this->params);
        $options[RequestOptions::HEADERS] = $this->app['credential']->getRequestHeaders();

        return $this->request('PATCH', $this->uri, $options);
    }

    /**
     * @throws ClientError
     */
    protected function requestPut(): array
    {
        $options[RequestOptions::JSON] = $this->app['credential']->getRequestParams($this->params);
        $options[RequestOptions::HEADERS] = $this->app['credential']->getRequestHeaders();

        return $this->request('PUT', $this->uri, $options);
    }

    /**
     * @throws ClientError
     */
    protected function requestPost(): array
    {
        $options[RequestOptions::JSON] = $this->app['credential']->getRequestParams($this->params);
        $options[RequestOptions::HEADERS] = $this->app['credential']->getRequestHeaders();

        return $this->request('POST', $this->uri, $options);
    }

    /**
     * @throws ClientError
     */
    protected function requestGet(): array
    {
        $options[RequestOptions::JSON] = $this->app['credential']->getRequestParams($this->params);
        $options[RequestOptions::HEADERS] = $this->app['credential']->getRequestHeaders();

        return $this->request('GET', $this->uri, $options);
    }
}
