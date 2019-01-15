<?php
/**
 * Copyright (c) 13.01.19 0:00.г. Саратов - year. Все права защищены.
 */

namespace core\Exception;


class ModelIncorrectValidatorException extends \Exception
{
    private $errors;
    public function __construct($errors)
    {
        parent::__construct('');
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}