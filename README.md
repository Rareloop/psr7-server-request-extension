# PSR7 ServerRequest Extension

Provides traits that add utility functions to a PSR7 `ServerResponse` subclass that make it easier to interact with the URI and input. Inspired by the API of [Laravel](https://laravel.com/docs/5.6/requests).

## Install

`composer install rareloop/psr7-server-request-extension`

## Create a ServerRequest

Create a subclass of a PSR7 compatible `ServerRequest` object (e.g. [Diactoros](https://github.com/zendframework/zend-diactoros)) and add the `InteractsWithInput` and `InteractsWithUri` traits.

```php
<?php

namespace App;

use Rareloop\Psr7ServerRequestExtension\InteractsWithInput;
use Rareloop\Psr7ServerRequestExtension\InteractsWithUri;
use Zend\Diactoros\ServerRequest;

class MyServerRequest extends ServerRequest
{
    use InteractsWithInput, InteractsWithUri;
}
```

## Usage

### Get the path

```php
$request->path();
```

### Get the URL

```php
$request->url(); // e.g. http://test.com/path
$request->fullUrl(); // e.g. http://test.com/path?foo=bar
```

### Get all query params

```php
$request->query();
```

### Get a specific query param

```php
$request->query('name');
$request->query('name', 'Jane'); // Defaults to "Jane" if not set
```

### Get all post params

```php
$request->post();
```

### Get a specific post param

```php
$request->post('name');
$request->post('name', 'Jane'); // Defaults to "Jane" if not set
```

### Get all input params

```php
$request->input();
```

### Get a specific input param

```php
$request->input('name');
$request->input('name', 'Jane'); // Defaults to "Jane" if not set
```

### Does the request have a specific input key?

```php
if ($request->has('name')) {
    // do something
}

if ($request->has(['name', 'age'])) {
    // do something if both 'name' and 'age' are present
}
```
