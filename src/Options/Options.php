<?php
namespace Sqlsrv\Options;

class Options
{

    protected $options;

    public function __construct()
    {
        $this->options = [];
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}

