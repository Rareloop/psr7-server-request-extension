<?php

namespace Rareloop\Psr7ServerRequestExtension;

use Tightenco\Collect\Support\Arr;

/**
 * Extension to a PSR7 ServerRequest object to make working with Input simpler
 */
trait InteractsWithInput
{
    public abstract function getQueryParams();
    public abstract function getParsedBody();

    public function input($key = null, $default = null)
    {
        $input = $this->post() + $this->query();

        if (!$key) {
            return $input;
        }

        return Arr::get($input, $key, $default);
    }

    public function has($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        $input = $this->input();

        return Arr::has($input, $keys);
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
