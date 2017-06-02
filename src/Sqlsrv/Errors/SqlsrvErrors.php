<?php
namespace Sqlsrv\Errors;

class SqlsrvErrors extends \ArrayObject
{

    protected $sql;

    protected $params;

    public function __construct(array $array = [])
    {
        $this->params = [];
        parent::__construct(SqlsrvErrors::validate($array));
    }

    public function setSql(string $sql): SqlsrvErrors
    {
        $this->sql = $sql;
        return $this;
    }

    public function setParams(array $params): SqlsrvErrors
    {
        $this->params = $params;
        return $this;
    }

    public function setErrors(): SqlsrvErrors
    {
        $this->exchangeArray(sqlsrv_errors());
        return $this;
    }

    public function append($value): void
    {
        if (is_array($value) && SqlsrvError::validate($value)) {
            $sqlsrvError = new SqlsrvError($value);
            if ($sqlsrvError->isValid()) {
                parent::append($sqlsrvError);
            }
        }
    }

    public function exchangeArray($input)
    {
        return parent::exchangeArray(SqlsrvErrors::validate($input));
    }

    protected static function validate(array $array): array
    {
        $errors = [];
        foreach ($array as $error) {
            $sqlsrvError = new SqlsrvError($error);
            if ($sqlsrvError->isValid()) {
                $errors[] = $sqlsrvError;
            }
        }
        return $errors;
    }
}

