<?php
namespace Sqlsrv;

class PreparedStatement extends Statement
{

    public function __construct($statement)
    {
        parent::__construct($statement);
    }
}

