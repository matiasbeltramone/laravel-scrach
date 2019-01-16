<?php

namespace App;

class Example
{
    /**
     * @var Foo
     */
    private $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }
}
