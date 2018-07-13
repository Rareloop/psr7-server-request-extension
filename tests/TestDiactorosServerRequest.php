<?php

namespace Rareloop\Psr7ServerRequestExtension\Test;

use Rareloop\Psr7ServerRequestExtension\InteractsWithInput;
use Rareloop\Psr7ServerRequestExtension\InteractsWithUri;
use Zend\Diactoros\ServerRequest;

class TestDiactorosServerRequest extends ServerRequest
{
    use InteractsWithUri, InteractsWithInput;
}
