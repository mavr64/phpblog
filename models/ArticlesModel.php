<?php

namespace models;

use core\DBDriver;
use core\Validator;

class ArticlesModel extends BaseModel
{
    protected $schema = [
        'id' => [
            'type' => Validator::TYPE_INTEGER,
            'primary' => true
        ],
        'title' => [
            'type' => Validator::TYPE_STRING,
            'length' => [5, 50],
            'not_blank' => true,
            'require' => true
        ],
        'content' => [
            'type' => Validator::TYPE_STRING,
            'length' => Validator::LENGTH_BIG,
            'not_blank' => true,
            'require' => true
        ]
    ];
	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, $validator, 'articles', 'id_article');
		$this->validator->setRules($this->schema);
	}
	
/*	СТАЛО ЛИШНИМ
	public function addArticle($id_user,$title,$content)
	{
        $sql = sprintf("INSERT INTO %s (id_user, title, content) VALUES (:id_user,:title,:content)", $this->table);
        $params=[':id_user' => $id_user, ':title' => $title, ':content' => $content ];
        $query = DBDriver::$db->prepare($sql);
        $query->execute($params);
        return DB::$db->lastInsertId();
	}
	
	public function saveArticle($title,$content,$id)
    {
        $sql = sprintf("UPDATE %s SET title=:title, content=:content, dt_ed=now() WHERE id_article =:id_article", $this->table);
        $params=[':title' => $title, ':content' => $content, ':id_article' => $id];
        $query = DBDriver::$db->prepare($sql);
        $query->execute($params);
        return DB::$db->lastInsertId();
    }

    public function deleteOneById($id)
    {
        $sql = sprintf('DELETE FROM `%s` WHERE `%s` = :id', $this->table, $this->field);
        $params = ['id' => $id];
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetch();

    }*/
}