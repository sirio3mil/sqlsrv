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

    public function fetch_array(FetchArrayProperties $fetchArrayProperties = null)
    {
        if (! $this->resource) {
            return null;
        }
        if(!$fetchArrayProperties){
            $fetchArrayProperties = new FetchArrayProperties();
        }
        return sqlsrv_fetch_array($this->resource, $fetchArrayProperties->getFetchType()->getValue(), $fetchArrayProperties->getRowScroll()->getValue(), $fetchArrayProperties->getOffset());
    }

    public function fetch_object(FetchObjectProperties $fetchObjectProperties = null)
    {
        if (! $this->resource) {
            return null;
        }
        if(!$fetchObjectProperties){
            $fetchObjectProperties = new FetchObjectProperties();
        }
        return sqlsrv_fetch_object($this->resource, $fetchObjectProperties->getClassName(), $fetchObjectProperties->getConstructorParams(), $fetchObjectProperties->getRowScroll()->getValue(), $fetchObjectProperties->getOffset());
    }

    public function fetch(FetchProperties $fetchProperties = null): ?bool
    {
        if (! $this->resource) {
            return false;
        }
        if(!$fetchProperties){
            $fetchProperties = new FetchProperties();
        }
        return sqlsrv_fetch($this->resource, $fetchProperties->getRowScroll()->getValue(), $fetchProperties->getOffset());
    }

    public function free(): bool
    {
        return sqlsrv_free_stmt($this->resource);
    }

    public function get_field(int $fieldIndex, int $getAsType = null)
    {
        return sqlsrv_get_field($this->resource, $fieldIndex, $getAsType);
    }

    public function has_rows(): bool
    {
        return sqlsrv_has_rows($this->resource);
    }

    public function next_result(): ?bool
    {
        return sqlsrv_next_result($this->resource);
    }

    public function num_fields()
    {
        return sqlsrv_num_fields($this->resource);
    }

    public function num_rows()
    {
        return sqlsrv_num_rows($this->resource);
    }

    public function rows_affected()
    {
        return sqlsrv_rows_affected($this->resource);
    }

    public function send_stream_data(): bool
    {
        return sqlsrv_send_stream_data($this->resource);
    }
}
