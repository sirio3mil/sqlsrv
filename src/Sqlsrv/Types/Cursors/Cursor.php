<?php
namespace Sqlsrv\Types\Cursors;

use Sqlsrv\Types\IntegerType;

class Cursor extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

