<?php
/**
 * Copyright (c) 29.12.18 2:17.г. Саратов - year. Все права защищены.
 */


namespace core;


class DBDriver
{
    const FETCH_ALL = 'all';
    const FETCH_ONE = 'one';

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function select($sql, array $params = [], $fetch = self::FETCH_ALL)
    {
//        $sql = sprintf('SELECT * FROM `%s` ORDER BY `%s` ASC', $this->table, $this->field);
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $this->DBCheckError($query);
        return $fetch === self::FETCH_ALL ? $query->fetchAll() : $query->fetch();
    }

    public function insert($table, array $params)
    {
        $columns = sprintf('(%s)', implode(', ', array_keys($params)));
        $masks = sprintf('(:%s)', implode(', :', array_keys($params)));
/*        var_dump($columns);
        var_dump($masks);
        die;*/

        $sql = sprintf("INSERT INTO %s %s VALUES %s", $table, $columns, $masks);
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $this->pdo->lastInsertId();
    }

    public function update($table, $params, $where)
    {
        $param_ = array_slice($params,0, count($params));
        $id = array_pop($param_);
        $keys = array_keys($param_);
        $str .= '' . $keys[0] . ' = :' . $keys[0];
        for ($i=1, $size = count($keys); $i < $size; $i++)
        {
            $str .= ', ' . $keys[$i] . ' = :' . $keys[$i];
        }

        $sql = sprintf("UPDATE %s SET %s WHERE %s", $table, $str, $where);
/*        var_dump($sql);
        var_dump($params);
        die;*/
        $query = $this->pdo->prepare($sql);
 /*       if (!$query) {
            echo "\nPDO::errorInfo():\n";
            print_r($this->pdo->errorInfo());
        }*/
        $query->execute($params);
        return $id;
    }

    public function delete($table, $where)
    {
        //
    }

    /**Проверка выполнения запроса к БД
     * @param $query
     */
    private function DBCheckError($query)
    {
        $info = $query->errorInfo();

        if($info[0] != $this->pdo::ERR_NONE){
            echo print_r ($info);
            exit($info[2]);
        }
    }
}