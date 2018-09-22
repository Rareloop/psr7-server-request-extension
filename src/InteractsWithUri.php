<?php

namespace Rareloop\Psr7ServerRequestExtension;

/**
 * Extension to a PSR7 ServerRequest object to make working with the URI simpler
 */
trait InteractsWithUri
{
    public abstract function getUri();
    public abstract function getMethod();

    public function path() : string
    {
        return $this->getUri()->getPath();
    }

    public function url() : string
    {
        $uri = $this->getUri();

        return $uri->getScheme() .
            '://' .
            $uri->getHost() .
            $uri->getPath();
    }

    public function fullUrl() : string
    {
        $query = $this->getUri()->getQuery();

        return !empty($query) ? $this->url() . '?' . $query : $this->url();
    }

    public function method() : string
    {
        return strtolower($this->getMethod());
    }

    public function isMethod($method) : bool
    {
        return $method === $this->method();
    }
}
