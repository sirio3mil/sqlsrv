<?php
namespace Options;

class QueryOptions extends Options
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setQueryTimeout(int $queryTimeout): QueryOptions
    {
        $this->options['QueryTimeout'] = ($queryTimeout < 0) ? 0 : $queryTimeout;
        return $this;
    }
}

