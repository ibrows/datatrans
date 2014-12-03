<?php

namespace Ibrows\DataTrans;

use Saxulum\HttpClient\History;
use Ibrows\DataTrans\Error\DataTransErrorHandler;
use Saxulum\HttpClient\HistoryEntry;
use Saxulum\HttpClient\HttpClientInterface;
use Saxulum\HttpClient\Request;

class DataTransRequest
{
    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var DataTransErrorHandler
     */
    protected $saferpayErrorHandler;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient, DataTransErrorHandler $saferpayErrorHandler)
    {
        $this->httpClient = $httpClient;
        $this->saferpayErrorHandler = $saferpayErrorHandler;
    }

    /**
     * @param $method
     * @param $url
     * @param  null                         $content
     * @param  array                        $headers
     * @param  History|null                 $history
     * @return \Saxulum\HttpClient\Response
     * @throws \Exception
     */
    public function request($method, $url, $content = null, $headers = array(), History $history = null)
    {
        $headers = $this->prepareHeaders($method, $content, $headers);

        $request = new Request(
            '1.1',
            $method,
            $url,
            $headers,
            $content
        );

        $response = $this->httpClient->request($request);

        if (400 <= $response->getStatusCode()) {
            $this->saferpayErrorHandler->response($response);
        }

        if (null !== $history) {
            $history->addHistoryEntry(new HistoryEntry($request, $response));
        }

        return $response;
    }

    /**
     * @param  string      $method
     * @param  string|null $content
     * @param  array       $headers
     * @return mixed
     */
    protected function prepareHeaders($method, $content, $headers)
    {
        if ($method === Request::METHOD_POST || $method === Request::METHOD_PUT) {
            if (!isset($headers['Content-Type'])) {
                $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            }

            if (!isset($headers['Content-Length'])) {
                $headers['Content-Length'] = strlen($content);
            }
        }

        return $headers;
    }
}
