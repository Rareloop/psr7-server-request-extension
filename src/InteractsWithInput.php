<?php

namespace Rareloop\Psr7ServerRequestExtension;

/**
 * Extension to a PSR7 ServerRequest object to make working with Input simpler
 */
trait InteractsWithInput
{
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
