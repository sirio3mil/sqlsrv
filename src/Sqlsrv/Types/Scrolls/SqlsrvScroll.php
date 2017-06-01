<?php
namespace Sqlsrv\Types\Scrolls;

class SqlsrvScroll extends Scroll
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

