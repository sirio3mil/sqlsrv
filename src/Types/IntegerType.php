<?php
namespace Types;

class IntegerType extends Type
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

