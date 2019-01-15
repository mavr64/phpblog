<?php

namespace models;

class UserModel extends BaseModel
{
    public function __construct(DBDriver $db)
    {
        parent::__construct($db, 'users', 'id_user');
	}
	
	public function Add()
	{
		
	}
	
	public function Edit()
	{
		
	}
}