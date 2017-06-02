<?php
namespace Sqlsrv;

use Sqlsrv\Errors\SqlsrvErrors;
use Sqlsrv\Exceptions\SqlsrvException;

class Connection
{

    protected $resource;

    protected $sqlsrvErrors;

    public function __construct()
    {
        $this->sqlsrvErrors = new SqlsrvErrors();
    }

    protected function setErrors(string $sql = "", array $params = []): void
    {
        $this->sqlsrvErrors->setErrors()
            ->setSql($sql)
            ->setParams($params);
    }

    protected function logErrors(): void
    {}

    protected function reportError()
    {
        throw new SqlsrvException($this->sqlsrvErrors);
    }
}

