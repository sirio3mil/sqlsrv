<?php
namespace Sqlsrv\Types\Scrolls;

use Sqlsrv\Types\IntegerType;

class Scroll extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

