<?php

namespace models;

use core\DB;

class ErrorModel extends BaseModel
{
	public function __construct(\PDO $db)
	{
		parent::__construct($db, 'articles', 'id_article');
	}
}