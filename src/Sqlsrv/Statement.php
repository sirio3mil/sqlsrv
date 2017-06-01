<?php
namespace Sqlsrv;

class Statement extends Resource
{

    public function __construct(resource $resource)
    {
        parent::__construct($resource);
    }
}
