<?php

namespace HttpServerHandler\Tests\Double;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;

class ServerRequestDouble implements ServerRequestInterface
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

    public function getRequestTarget()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withRequestTarget($requestTarget)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getMethod()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withMethod($method)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getUri()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getServerParams()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getCookieParams()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withCookieParams(array $cookies)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getQueryParams()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withQueryParams(array $query)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getUploadedFiles()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getParsedBody()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withParsedBody($data)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getAttributes()
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function getAttribute($name, $default = null)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withAttribute($name, $value)
    {
        throw new \BadMethodCallException(__METHOD__);
    }

    public function withoutAttribute($name)
    {
        throw new \BadMethodCallException(__METHOD__);
    }
}
