<?php
namespace Sqlsrv;

class Statement
{

    protected $statement;

    public function __construct($statement)
    {
        $this->statement = $statement;
    }
}
