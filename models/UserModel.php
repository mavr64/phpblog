<?php

namespace models;

use core\DBDriver;
use core\Validator;
class UserModel extends BaseModel
{
	protected $schema = [
        'id' => [
            'type' => Validator::TYPE_INTEGER,
            'primary' => true
        ],
        'login' => [
            'type' => Validator::TYPE_STRING,
            'length' => [3, 50],
            'not_blank' => true,
            'require' => true
        ],
        'password' => [
            'type' => Validator::TYPE_STRING,
            'length' => [4, 50],
            'not_blank' => true,
            'require' => true
		],
/*		'name' => [
            'type' => Validator::TYPE_STRING,
            'length' => [3, 50],
            'not_blank' => true,
            'require' => true
        ]*/
    ];

	public function __construct(DBDriver $db, Validator $validator)
    {
		parent::__construct($db, $validator, 'users', 'id_user');
		$this->validator->setRules($this->schema);
    }
    
    public function signUp(array $fields)
    {
        $this->validator->execute($fields);

        if (!$this->validator->success) {
            # throw new exception
        }

        $this->add([
            'login' => $this->validator->clean['login'],
            'password' => $this->getHash($this->validator->clean['password'])
        ]);
    }

    public function getHash($password)
    {
        return md5($password . 'onmioniu_189343');
    }
/*	
	public function Add()
	{
		
	}
	
	public function Edit()
	{
		
	}*/
}