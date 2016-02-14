<?php

namespace spec\App\Http\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\ProductController');
    }
}
