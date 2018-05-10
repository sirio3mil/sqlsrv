<?php
namespace Sqlsrv\Properties;

use Sqlsrv\Types\Fetchs\FetchTypeAssoc;
use Sqlsrv\Types\Fetchs\FetchType;

class FetchArrayProperties extends FetchProperties
{

    protected $fetchType;

    public function __construct()
    {
        $this->fetchType = new FetchTypeAssoc();
        parent::__construct();
    }

    public function setFetchType(FetchType $fetchType): FetchArrayProperties
    {
        $this->fetchType = $fetchType;
        return $this;
    }

    public function getFetchType(): FetchType
    {
        return $this->fetchType;
    }
}

