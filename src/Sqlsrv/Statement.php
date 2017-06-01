<?php
namespace Sqlsrv;

class Statement
{

    protected $statement;

    public function __construct($statement)
    {
        $this->statement = $statement;
    }

    public function fetch_array(int $fetchType = SQLSRV_FETCH_ASSOC, int $row = SQLSRV_SCROLL_RELATIVE, int $offset = 0)
    {
        if (! $this->statement) {
            return null;
        }
        return sqlsrv_fetch_array($this->statement, $fetchType, $row, $offset);
    }

    public function fetch_object(string $className = "stdClass", array $ctorParams = [], int $row = SQLSRV_SCROLL_RELATIVE, int $offset = 0)
    {
        if (! $this->statement) {
            return null;
        }
        return sqlsrv_fetch_object($this->statement, $className, $ctorParams, $row, $offset);
    }

    public function fetch(int $row = SQLSRV_SCROLL_RELATIVE, int $offset = 0): ?bool
    {
        return sqlsrv_fetch($this->statement, $row, $offset);
    }

    public function free(): bool
    {
        return sqlsrv_free_stmt($this->statement);
    }
}
