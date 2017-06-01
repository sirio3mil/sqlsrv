<?php
namespace Sqlsrv;

use Sqlsrv\Errors\SqlsrvErrors;
use Sqlsrv\Options\SqlsrvConnectionOptions;
use Sqlsrv\Exceptions\SqlsrvException;
use Sqlsrv\Options\QueryOptions;

class Sqlsrv
{

    protected $connection;

    protected $transactions;

    protected $sqlsrvConnectionOptions;

    protected $sqlsrvErrors;

    public function __construct(SqlsrvConnectionOptions $sqlsrvConnectionOptions)
    {
        $this->sqlsrvConnectionOptions = $sqlsrvConnectionOptions;
        $this->sqlsrvErrors = new SqlsrvErrors();
        $this->transactions = 0;
        $this->params = [];
    }

    public function connect(): bool
    {
        $this->connection = sqlsrv_connect($this->sqlsrvConnectionOptions->getServerName(), $this->sqlsrvConnectionOptions->getOptions());
        if (! $this->connection) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        return true;
    }

    public function begin_transaction(): bool
    {
        if (! $this->connection) {
            return false;
        }
        if (! $this->transactions && ! sqlsrv_begin_transaction($this->connection)) {
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
        if (! $this->connection) {
            return false;
        }
        if ($this->transactions === 1 && ! sqlsrv_commit($this->connection)) {
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
        if (! $this->connection) {
            return false;
        }
        if ($this->transactions && ! sqlsrv_rollback($this->connection)) {
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
        if (! $this->connection) {
            return false;
        }
        if ($this->transactions) {
            $this->transactions = 1;
            $this->commit();
        }
        if (! sqlsrv_close($this->connection)) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        return true;
    }

    public function prepare(string $sql, array $params = [], QueryOptions $queryOptions = new QueryOptions()): ?PreparedStatement
    {
        if (! $this->connection) {
            return null;
        }
        if (! $statement = sqlsrv_prepare($this->connection, $sql, $params, $queryOptions->getOptions())) {
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
        if (! $this->connection) {
            return null;
        }
        if (! $statement = sqlsrv_query($this->connection, $sql, $params, $queryOptions->getOptions())) {
            $this->rollback();
            $this->setErrors($sql, $params);
            $this->logErrors();
            $this->reportError();
            return null;
        }
        return new Statement($statement);
    }

    protected function setErrors(string $sql = "", array $params = []): void
    {
        $this->sqlsrvErrors->exchangeArray(sqlsrv_errors());
        $this->sqlsrvErrors->setSql($sql);
        $this->sqlsrvErrors->setParams($params);
    }

    protected function logErrors(): void
    {}

    protected function reportError()
    {
        throw new SqlsrvException($this->sqlsrvErrors);
    }
}

