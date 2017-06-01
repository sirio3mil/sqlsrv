<?php
namespace Types\Cursors;

class SqlsrvCursor extends Cursor
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}

