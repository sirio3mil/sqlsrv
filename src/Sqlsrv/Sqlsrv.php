<?php
namespace Sqlsrv;

use Sqlsrv\Errors\SqlsrvErrors;
use Sqlsrv\Options\SqlsrvConnectionOptions;
use Sqlsrv\Exceptions\SqlsrvException;

class Sqlsrv
{

    protected $connection;

    protected $sqlsrvConnectionOptions;

    protected $sqlsrvErrors;

    public function __construct(SqlsrvConnectionOptions $sqlsrvConnectionOptions)
    {
        $this->sqlsrvConnectionOptions = $sqlsrvConnectionOptions;
        $this->sqlsrvErrors = new SqlsrvErrors();
    }

    public function connect(): Sqlsrv
    {
        $this->connection = sqlsrv_connect($this->sqlsrvConnectionOptions->getServerName(), $this->sqlsrvConnectionOptions->getOptions());
        if (! $this->connection) {
            $this->setErrors();
            $this->reportError();
        }
    }

    protected function setErrors()
    {
        $this->sqlsrvErrors->exchangeArray(sqlsrv_errors());
    }

    protected function reportError()
    {
        throw new SqlsrvException($this->sqlsrvErrors->offsetGet(0));
    }
}

