<?php

namespace models;

use core\DBDriver;
use core\Validator;
use core\Exception\ModelIncorrectValidatorException;

abstract class BaseModel
{
    protected $validator;
    protected $db;
    protected $table;
    protected $field;

    /**
     * BaseModel constructor.
     * @param DBDriver $db подключение БД
     * @param $table - имя таблицы
     * @param $field - имя поля `id` таблицы
     */
    public function __construct(DBDriver $db,  Validator $validator, $table, $field)
	{
		$this->db = $db;
		$this->table = $table;
        $this->field = $field;
        $this->validator = $validator;
	}

    public function getAll($params = [])
	{
		$sql = sprintf('SELECT * FROM `%s` ORDER BY `%s` ASC', $this->table, $this->field);
		$query = $this->db->select($sql);

		return $query;
	}

	public function getOneById($id)
	{
		$sql = sprintf('SELECT * FROM `%s` WHERE `%s` = :id', $this->table, $this->field);
		$params = ['id' => $id];
        $query = $this->db->select($sql, $params, DBDriver::FETCH_ONE);

        return $query;
	}

    public function add(array $params, $needValidation = true)
    {
        if($needValidation)
        {
            $this->validator->execute($params);
            if(!$this->validator->success)
            {
                // обработка ошибки
                throw new ModelIncorrectValidatorException($this->validator->errors);
                $this->validator->errors;
            }

            $params = $this->validator->clean;
        }
        $query = $this->db->insert($this->table, $params);
        return $query;
    }

    public function edit(array $params, $where)
    {
        $this->validator->execute($params);
        if(!$this->validator->success)
        {
            // обработка ошибки
            $this->validator->errors;
        }
        $query = $this->db->update($this->table, $params, $where);
        return $query;
    }
//=========================================================================================================
    /**Проверка правильности id
     * @param $id
     * @return bool
     */
    public static function CheckId($id)
    {
        return ctype_digit($id);
    }

    /**Проверка правильности текста
     * @param $title
     * @return bool
     */
    public static function CheckText($text){
        return mb_strlen($text)>0; // ",$title); //("#^[aA-zZа-яА-ЯёЁ0-9\ -_]+$#",$title);
    }

/*    public static function db_query($sql, $params = [])
    {
        self::$db = DB::connect();
        $query = self::$db->prepare($sql);
        $query->execute($params);
        self::db_check_error($query);
        return $query;
    }*/
}