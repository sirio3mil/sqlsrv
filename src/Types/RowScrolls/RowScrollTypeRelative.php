<?php
namespace Sqlsrv\Types\RowScrolls;

class RowScrollTypeRelative extends RowScrollType
{

    public function __construct()
    {
        parent::__construct(SQLSRV_SCROLL_RELATIVE);
    }
}

