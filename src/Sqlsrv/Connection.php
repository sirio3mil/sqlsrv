<?php
namespace Sqlsrv;

use Sqlsrv\Errors\SqlsrvErrors;

class Connection
{

    protected $resource;

    protected $sqlsrvErrors;

    public function __construct()
    {
        $this->sqlsrvErrors = new SqlsrvErrors();
    }

    public function errors(): SqlsrvErrors
    {
        return $this->sqlsrvErrors->setErrors();
    }
}

