<?php
namespace Sqlsrv\Exceptions;

use Sqlsrv\Errors\SqlsrvErrors;

class SqlsrvException extends \Exception
{

    public function __construct(SqlsrvErrors $sqlsrvErrors)
    {
        parent::__construct($sqlsrvErrors->offsetGet(0)->getMessage());
    }
}

