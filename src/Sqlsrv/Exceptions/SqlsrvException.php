<?php
namespace Sqlsrv\Exceptions;

use Sqlsrv\Errors\SqlsrvError;

class SqlsrvException extends \Exception
{

    public function __construct(SqlsrvError $sqlsrvError)
    {
        parent::__construct($sqlsrvError->getMessage(), $sqlsrvError->getCode());
    }
}

