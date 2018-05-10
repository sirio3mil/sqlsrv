<?php
namespace Sqlsrv\Options;

class SqlsrvConnectionOptions extends ConnectionOptions
{

    public function __construct(string $serverName)
    {
        parent::__construct($serverName);
    }

    public function setUser(string $userName): SqlsrvConnectionOptions
    {
        $this->options['UID'] = $userName;
        return $this;
    }

    public function setPassword(string $password): SqlsrvConnectionOptions
    {
        $this->options['PWD'] = $password;
        return $this;
    }

    public function setCharacterSet(string $characterSet): SqlsrvConnectionOptions
    {
        $this->options['CharacterSet'] = ($characterSet === "UTF-8") ? "UTF-8" : SQLSRV_ENC_CHAR;
        return $this;
    }
}

