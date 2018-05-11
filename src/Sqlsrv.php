<?php

namespace Sqlsrv;

use Sqlsrv\Options\SqlsrvConnectionOptions;
use Sqlsrv\Options\QueryOptions;

class Sqlsrv extends Connection
{

    protected $transactions;

    protected $sqlsrvConnectionOptions;

    public function __construct(SqlsrvConnectionOptions $sqlsrvConnectionOptions)
    {
        $this->sqlsrvConnectionOptions = $sqlsrvConnectionOptions;
        $this->transactions = 0;
        parent::__construct();
    }

    public function connect(): bool
    {
        $this->resource = sqlsrv_connect($this->sqlsrvConnectionOptions->getServerName(),
            $this->sqlsrvConnectionOptions->getOptions());
        if (!$this->resource) {
            $this->setErrors();
            return false;
        }
        return true;
    }

    public function begin_transaction(): bool
    {
        if (!$this->resource) {
            return false;
        }
        if (!$this->transactions && !sqlsrv_begin_transaction($this->resource)) {
            return false;
        }
        ++$this->transactions;
        return true;
    }

    public function commit(): bool
    {
        if (!$this->resource) {
            return false;
        }
        if ($this->transactions === 1 && !sqlsrv_commit($this->resource)) {
            return false;
        }
        --$this->transactions;
        return true;
    }

    public function rollback(): bool
    {
        if (!$this->resource) {
            return false;
        }
        if (!$this->transactions) {
            return false;
        }
        $this->transactions = 0;
        return sqlsrv_rollback($this->resource);
    }

    public function close(): bool
    {
        if (!$this->resource) {
            return false;
        }
        if ($this->transactions) {
            $this->transactions = 1;
            $this->commit();
        }
        if (!sqlsrv_close($this->resource)) {
            return false;
        }
        return true;
    }

    public function prepare(string $sql, array $params = [], QueryOptions $queryOptions = null): ?PreparedStatement
    {
        if (!$this->resource) {
            return null;
        }
        if (!$queryOptions) {
            $queryOptions = new QueryOptions();
        }
        if (!$statement = sqlsrv_prepare($this->resource, $sql, $params, $queryOptions->getOptions())) {
            $this->setErrors();
            $this->rollback();
            return null;
        }
        return new PreparedStatement($statement);
    }

    public function query(string $sql, array $params = [], QueryOptions $queryOptions = null): ?Statement
    {
        if (!$this->resource) {
            return null;
        }
        if (!$queryOptions) {
            $queryOptions = new QueryOptions();
        }
        if (!$statement = sqlsrv_query($this->resource, $sql, $params, $queryOptions->getOptions())) {
            $this->setErrors();
            $this->rollback();
            return null;
        }
        return new Statement($statement);
    }
}

