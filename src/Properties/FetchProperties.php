<?php
namespace Sqlsrv\Properties;

use Sqlsrv\Types\RowScrolls\RowScrollType;
use Sqlsrv\Types\RowScrolls\RowScrollTypeRelative;

class FetchProperties
{

    protected $rowScroll;

    protected $offset;

    public function __construct()
    {
        $this->rowScroll = new RowScrollTypeRelative();
        $this->offset = 0;
    }

    public function setRowScroll(RowScrollType $rowScroll): FetchProperties
    {
        $this->rowScroll = $rowScroll;
        return $this;
    }

    public function setOffset(int $offset): FetchProperties
    {
        $this->offset = ($offset < 0) ? 0 : $offset;
        return $this;
    }

    public function getRowScroll(): RowScrollType
    {
        return $this->rowScroll;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}

