<?php
namespace Resources;

class Resource
{

    protected $resource;

    public function __construct(resource $resource)
    {
        $this->resource = $resource;
    }

    public function getResource(): resource
    {
        return $this->resource;
    }
}

