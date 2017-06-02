<?php
namespace Sqlsrv\Errors;

class SqlsrvError
{

    protected $state;

    protected $code;

    protected $message;

    public function __construct(array $error)
    {
        if (SqlsrvError::validate($error)) {
            $this->code = $error['code'];
            $this->message = $error['message'];
            $this->state = $error['SQLSTATE'];
        }
    }

    public function isValid(): bool
    {
        if ($this->getCode()) {
            return true;
        }
        return false;
    }

    public function getCode(): int
    {
        return $this->code ? intval($this->code) : 0;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    protected static function validate(array $array)
    {
        if (! array_key_exists('SQLSTATE', $array)) {
            return false;
        }
        if (! array_key_exists('code', $array)) {
            return false;
        }
        if (! array_key_exists('message', $array)) {
            return false;
        }
        return true;
    }
}

