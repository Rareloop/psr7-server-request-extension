<?php

namespace Rareloop\Psr7ServerRequestExtension;

/**
 * Extension to a PSR7 ServerRequest object to make accessing input more convenient
 */
trait Psr7ServerRequestExtension
{
    public abstract function getUri();
    public abstract function getQueryParams();
    public abstract function getParsedBody();

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
        $uri = $this->getUri();

        return $this->url() .
            '?' .
            $uri->getQuery();
    }

    public function method() : string
    {
        return strtolower($this->getMethod());
    }

    public function isMethod($method) : bool
    {
        return $method === $this->method();
    }

    public function input($key = null, $default = null)
    {
        $input = $this->post() + $this->query();

        if (!$key) {
            return $input;
        }

        return $input[$key] ?? $default;
    }

    public function has($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        $input = $this->input();

        foreach ($keys as $k) {
            if (!isset($input[$k])) {
                return false;
            }
        }

        return true;
    }

    public function query($key = null, $default = null)
    {
        $get = $this->getQueryParams();
        $get = is_array($get) ? $get : [];

        if (!$key) {
            return $get;
        }

        return $get[$key] ?? $default;
    }

    public function post($key = null, $default = null)
    {
        $post = $this->getParsedBody();
        $post = is_array($post) ? $post : [];

        if (!$key) {
            return $post;
        }

        return $post[$key] ?? $default;
    }
}
