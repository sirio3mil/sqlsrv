<?php
namespace Types\Scrolls;

use \Types\IntegerType;

class Scroll extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

