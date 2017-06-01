<?php
namespace Sqlsrv\Errors;

class SqlsrvErrors extends \ArrayObject
{

    protected $sql;

    protected $params;

    public function __construct(array $array)
    {
        $this->params = [];
        parent::__construct(SqlsrvErrors::validate($array));
    }

    public function setSql(string $sql): void
    {
        $this->sql = $sql;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function append($value): void
    {
        if (is_array($value) && SqlsrvError::validate($value)) {
            $sqlsrvError = new SqlsrvError($value);
            if ($sqlsrvError->getCode()) {
                parent::append($sqlsrvError);
            }
        }
    }

    public function exchangeArray($input)
    {
        $errors = [];
        foreach ($input as $error) {
            $sqlsrvError = new SqlsrvError($error);
            if ($sqlsrvError->getCode()) {
                $errors[] = $sqlsrvError;
            }
        }
        return parent::exchangeArray($errors);
    }

    protected static function validate(array $array): array
    {
        $errors = [];
        foreach ($array as $error) {
            $sqlsrvError = new SqlsrvError($error);
            if ($sqlsrvError->getCode()) {
                $errors[] = $sqlsrvError;
            }
        }
        return $errors;
    }
}

