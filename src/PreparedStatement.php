<?php
namespace Sqlsrv;

class PreparedStatement extends Statement
{

    public function __construct($statement)
    {
        parent::__construct($statement);
    }

    public function cancel(): bool
    {
        return sqlsrv_cancel($this->resource);
    }

    public function execute(): bool
    {
        return sqlsrv_execute($this->resource);
    }
}

