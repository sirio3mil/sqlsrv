<?php
namespace Sqlsrv\Types\Fetchs;

use Sqlsrv\Types\IntegerType;

class FetchType extends IntegerType
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

