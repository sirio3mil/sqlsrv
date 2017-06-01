<?php
namespace Options;

// TODO validate all possible options https://docs.microsoft.com/en-us/sql/connect/php/connection-options
class ConnectionOptions extends Options
{

    protected $serverName;

    public function __construct(string $serverName)
    {
        $this->serverName = $serverName;
        parent::__construct();
    }

    public function setDatabase(string $database): ConnectionOptions
    {
        $this->options['Database'] = $database;
        return $this;
    }

    public function setReturnDatesAsStrings(bool $returnDatesAsStrings): ConnectionOptions
    {
        $this->options['ReturnDatesAsStrings'] = $returnDatesAsStrings;
        return $this;
    }

    public function setLoginTimeout(int $loginTimeout): ConnectionOptions
    {
        $this->options['LoginTimeout'] = ($loginTimeout < 0) ? 0 : $loginTimeout;
        return $this;
    }
}

