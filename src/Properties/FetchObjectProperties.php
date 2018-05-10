<?php
namespace Sqlsrv\Properties;

class FetchObjectProperties extends FetchProperties
{

    protected $className;

    protected $ctorParams;

    public function __construct()
    {
        $this->className = "stdClass";
        $this->ctorParams = [];
        parent::__construct();
    }

    public function setClassName(string $className): FetchObjectProperties
    {
        $this->className = $className;
        return $this;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setConstructorParams(array $ctorParams): FetchObjectProperties
    {
        $this->ctorParams = $ctorParams;
        return $this;
    }

    public function getConstructorParams(): array
    {
        return $this->ctorParams;
    }
}

