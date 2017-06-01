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

    public function setSendStreamParamsAtExec(bool $sendStreamParamsAtExec): QueryOptions
    {
        $this->options['SendStreamParamsAtExec'] = $sendStreamParamsAtExec;
        return $this;
    }

    public function setScrollable(\Types\Cursors\SqlsrvCursor $sqlsrvCursor): QueryOptions
    {
        $this->options['Scrollable'] = $sqlsrvCursor->getValue();
        return $this;
    }
}

