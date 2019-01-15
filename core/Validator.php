<?php
/**
 * Copyright (c) 01.01.19 23:15.г. Саратов - year. Все права защищены.
 */

namespace core;


use core\Exception\ValidatorException;

class Validator
{
    const LENGTH_BIG = 25000;
    const TYPE_STRING = 'string';
    const TYPE_INT = 'int';
    const TYPE_INTEGER = 'integer';
    /**
     * @var array - массив полей без ошибок
     */
    public $clean = [];
    /**
     * @var array - массив полей с ошибками
     */
    public $errors = [];
    /**
     * @var bool - флаг проверки без ошибок
     */
    public $success = false;
    /**
     * @var - правила проверки
     */
    private $rules;

    /**
     * @param array $fields - массив с полями формы ввода
     */
    public function execute(array $fields)
    {
        if(!$this->rules){
                // error
                throw new ValidatorException('Rules for validation not found');
        }
        foreach ($this->rules as $name => $rule)
        {
            // Проверка на обязательное поле
            if (!isset($fields[$name]) && isset($rule['require']))
            {
                $this->errors[$name][] = sprintf('Field <b>%s</b> is require!', $name);
            }
            // поле не является обязательным и отсутствует
            if (!isset($fields[$name]) && (!isset($rule['require']) || !$rule['require']))
            {
                continue;
            }

            if (!isset($rule['not_blank']) && $this->isBlank($fields[$name]))
            {
                $this->errors[$name][] = sprintf('Field "$s" is not be blank', $name);
            }

            if (isset($rule['type']) && !$this->isTypeMatch($fields[$name], $rule['type']))
            {
                $this->errors[$name][] = sprintf('Field "$s" must be a %s type', $name, $rule['type']);

                /*if ($rule['type'] === 'string')
                {
                    $fields[$name] = trim(htmlspecialchars($fields[$name]))
                } elseif ($rule['type'] === 'integer')
                {
                    if (!is_numeric($fields[$name]))
                    {
                        $this->errors[$name][] = sprintf('')
                    }
                }*/
            }

            if (isset($rule['type']) && !$this->isLengthMatch($fields[$name], $rule['length']))
            {
                $this->errors[$name][] = sprintf('Field "$s" has an incorrect length', $name);
            }

// -------------------- ПОСЛЕДНЯЯ ПРОВЕРКА -------------------------------------------------------
            if (empty($this->errors[$name]))// && isset($fields[$name]))
            {
                if (isset($rule['type']) && $rule['type'] === 'string') {
                    $this->clean[$name] = htmlspecialchars(trim($fields[$name]));
                } elseif (isset($rule['type']) && $rule['type'] === 'int')
                {
                    $this->clean[$name] = (int)$fields[$name];
                } else
                {
                    $this->clean[$name] = $fields[$name];
                }
            }
// -------------------- ПОСЛЕДНЯЯ ПРОВЕРКА -------------------------------------------------------
        }

        if (empty($this->errors)){
            $this->success = true;
        }
/*        var_dump($this->errors);
        die;*/
    }

    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @return bool
     */
    public function isLengthMatch($field, $length): bool
    {
        if ($isArray = is_array($length)){
            $max = isset($length[1]) ? $length[1] : false;
            $min = isset($length[0]) ? $length[0] : false;
        } else {
            $max = $length;// но сначапла бы проверить на int $length, если нет, то ошибка
            $min = false;
        }

        if ($isArray && (!$max || !$min)) {
            // ошибка
            throw new ValidatorException('Incorrect data for min/max range of method isLengthMatch', 50);
        }

        if (!$isArray && !$max) {
            // ошибка
            throw new ValidatorException('Incorrect data for max range of method isLengthMatch', 51);
        }

        $maxIsMatch = $max ? $this->isLengthMaxMatch($field,$max) : false;
        $minIsMatch = $min ? $this->isLengthMinMatch($field,$min) : false;
        return $isArray ? $maxIsMatch && $minIsMatch : $maxIsMatch;
    }

    public function isLengthMaxMatch($field, $length)
    {
        return mb_strlen($field) > $length === false;
    }

    public function isLengthMinMatch($field, $length)
    {
        return mb_strlen($field) < $length === false;
    }

    public function isTypeMatch($field, $type)
    {
        switch ($type) {
            case 'string':
                return is_string($field);
                break;
            case 'int':
            case 'integer':
                return gettype($field) === 'integer' || ctype_digit($field);
                break;
            default:
                // ошибка
                throw new ValidatorException('Incorrect type of method isTypeMatch', 52);
                break;
        }
    }

    public function isBlank($field)
    {
        $field = trim($field);

        return $field === null || $field === '';
    }
}