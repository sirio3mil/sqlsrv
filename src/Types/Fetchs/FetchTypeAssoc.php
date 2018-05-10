<?php
namespace Sqlsrv\Types\Fetchs;

class FetchTypeAssoc extends FetchType
{

    public function __construct()
    {
        parent::__construct(SQLSRV_FETCH_ASSOC);
    }
}

