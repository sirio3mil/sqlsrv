<?php
namespace Sqlsrv;

use Sqlsrv\Options\SqlsrvConnectionOptions;
use Sqlsrv\Options\QueryOptions;

class Sqlsrv extends Connection
{

    protected $transactions;

    protected $sqlsrvConnectionOptions;

    protected $sqlsrvErrors;

    public function __construct(SqlsrvConnectionOptions $sqlsrvConnectionOptions)
    {
        $this->sqlsrvConnectionOptions = $sqlsrvConnectionOptions;
        $this->transactions = 0;
        $this->params = [];
        parent::__construct();
    }

    public function connect(): bool
    {
        $this->resource = sqlsrv_connect($this->sqlsrvConnectionOptions->getServerName(), $this->sqlsrvConnectionOptions->getOptions());
        if (! $this->resource) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        return true;
    }

    public function begin_transaction(): bool
    {
        if (! $this->resource) {
            return false;
        }
        if (! $this->transactions && ! sqlsrv_begin_transaction($this->resource)) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        ++ $this->transactions;
        return true;
    }

    public function commit(): bool
    {
        if (! $this->resource) {
            return false;
        }
        if ($this->transactions === 1 && ! sqlsrv_commit($this->resource)) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        -- $this->transactions;
        return true;
    }

    public function rollback(): bool
    {
        if (! $this->resource) {
            return false;
        }
        if ($this->transactions && ! sqlsrv_rollback($this->resource)) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        $this->transactions = 0;
        return true;
    }

    public function close(): bool
    {
        if (! $this->resource) {
            return false;
        }
        if ($this->transactions) {
            $this->transactions = 1;
            $this->commit();
        }
        if (! sqlsrv_close($this->resource)) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        return true;
    }

    public function prepare(string $sql, array $params = [], QueryOptions $queryOptions = new QueryOptions()): ?PreparedStatement
    {
        if (! $this->resource) {
            return null;
        }
        if (! $statement = sqlsrv_prepare($this->resource, $sql, $params, $queryOptions->getOptions())) {
            $this->rollback();
            $this->setErrors($sql, $params);
            $this->logErrors();
            $this->reportError();
            return null;
        }
        return new PreparedStatement($statement);
    }

    public function query(string $sql, array $params = [], QueryOptions $queryOptions = new QueryOptions()): ?Statement
    {
        if (! $this->resource) {
            return null;
        }
        if (! $statement = sqlsrv_query($this->resource, $sql, $params, $queryOptions->getOptions())) {
            $this->rollback();
            $this->setErrors($sql, $params);
            $this->logErrors();
            $this->reportError();
            return null;
        }
        return new Statement($statement);
    }
}

