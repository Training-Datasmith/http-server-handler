<?php

namespace HttpServerHandler\Tests\Double;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ResponseDouble implements ResponseInterface
{
    public function getProtocolVersion()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withProtocolVersion($version)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getHeaders()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function hasHeader($name)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getHeader($name)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getHeaderLine($name)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withHeader($name, $value)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withAddedHeader($name, $value)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withoutHeader($name)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getBody()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withBody(StreamInterface $body)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getStatusCode()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getReasonPhrase()
    {
        throw new \BadMethodCallException(__METHOD__);
    }
}
