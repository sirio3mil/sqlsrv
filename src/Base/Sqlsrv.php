<?php
namespace Base;

use Errors\SqlsrvErrors;
use Resources\ConnectionResource;
use Options\SqlsrvConnectionOptions;
use Exceptions\SqlsrvException;

class Sqlsrv
{

    protected $connectionResource;

    protected $sqlsrvConnectionOptions;

    protected $sqlsrvErrors;

    public function __construct(SqlsrvConnectionOptions $sqlsrvConnectionOptions)
    {
        $this->sqlsrvConnectionOptions = $sqlsrvConnectionOptions;
        $this->sqlsrvErrors = new SqlsrvErrors();
    }

    public function connect(): Sqlsrv
    {
        $conn = sqlsrv_connect($this->sqlsrvConnectionOptions->getServerName(), $this->sqlsrvConnectionOptions->getOptions());
        if ($conn) {
            $this->connectionResource = new ConnectionResource($conn);
        } else {
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

