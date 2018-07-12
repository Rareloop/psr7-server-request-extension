<?php

namespace Rareloop\Psr7ServerRequestExtension\Test;

use Rareloop\Psr7ServerRequestExtension\Psr7ServerRequestExtension;
use Zend\Diactoros\ServerRequest;

class TestDiactorosServerRequest extends ServerRequest
{
    use Psr7ServerRequestExtension;
}
