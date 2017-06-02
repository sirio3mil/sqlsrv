<?php
namespace Sqlsrv\Types\RowScrolls;

use Sqlsrv\Types\IntegerType;

class RowScrollType extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

