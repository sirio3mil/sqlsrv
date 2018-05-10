<?php

namespace Sqlsrv;

use Sqlsrv\Errors\SqlsrvErrors;

class Connection
{

    protected $resource;

    /** @var SqlsrvErrors $sqlsrvErrors */
    protected $sqlsrvErrors;

    public function __construct()
    {
        $this->sqlsrvErrors = new SqlsrvErrors();
    }

    public function setErrors(): Connection
    {
        $this->sqlsrvErrors->setErrors();
        return $this;
    }

    public function getErrors(): SqlsrvErrors
    {
        return $this->sqlsrvErrors;
    }
}

