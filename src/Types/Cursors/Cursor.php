<?php
namespace Types\Cursors;

use \Types\IntegerType;

class Cursor extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

