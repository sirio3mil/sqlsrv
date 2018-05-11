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
        if (!sqlsrv_cancel($this->resource)) {
            $this->setErrors();
            return false;
        }
        return true;
    }

    public function execute(): bool
    {
        if (!sqlsrv_execute($this->resource)) {
            $this->setErrors();
            return false;
        }
        return true;
    }
}

