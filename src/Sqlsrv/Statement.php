<?php
namespace Sqlsrv;

use Sqlsrv\Properties\FetchProperties;
use Sqlsrv\Properties\FetchArrayProperties;
use Sqlsrv\Properties\FetchObjectProperties;

class Statement extends Connection
{

    public function __construct($resource)
    {
        $this->resource = $resource;
        parent::__construct();
    }

    public function fetch_array(FetchArrayProperties $fetchArrayProperties = new FetchArrayProperties()): ?array
    {
        if (! $this->resource) {
            return null;
        }
        $result = sqlsrv_fetch_array($this->resource, $fetchArrayProperties->getFetchType()->getValue(), $fetchArrayProperties->getRowScroll()->getValue(), $fetchArrayProperties->getOffset());
        if ($result === false) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return null;
        }
        return $result;
    }

    public function fetch_object(FetchObjectProperties $fetchObjectProperties = new FetchObjectProperties()): ?callable
    {
        if (! $this->resource) {
            return null;
        }
        $result = sqlsrv_fetch_object($this->resource, $fetchObjectProperties->getClassName(), $fetchObjectProperties->getConstructorParams(), $fetchObjectProperties->getRowScroll()->getValue(), $fetchObjectProperties->getOffset());
        if ($result === false) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return null;
        }
        return $result;
    }

    public function fetch(FetchProperties $fetchProperties = new FetchProperties()): bool
    {
        if (! $this->resource) {
            return false;
        }
        $result = sqlsrv_fetch($this->resource, $fetchProperties->getRowScroll()->getValue(), $fetchProperties->getOffset());
        if ($result === false) {
            $this->setErrors();
            $this->logErrors();
            $this->reportError();
            return false;
        }
        return $result;
    }

    public function free(): bool
    {
        return sqlsrv_free_stmt($this->resource);
    }
}
