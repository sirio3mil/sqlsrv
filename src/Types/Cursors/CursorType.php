<?php
namespace Sqlsrv\Types\Cursors;

use Sqlsrv\Types\IntegerType;

class CursorType extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

