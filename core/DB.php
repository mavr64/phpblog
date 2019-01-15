<?php

namespace core;

class DB
{
    private const DB_TIP = 'mysql';
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'blog';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    public static $db;

	public static function getConnect()
	{
		if(self::$db === null){
            self::$db = self::getPDO();
        }
        return self::$db;
	}

	private static function getPDO()
    {
        $dsn = sprintf('%s:host=%s;dbname=%s', self::DB_TIP, self::DB_HOST, self::DB_NAME);
        return new \PDO($dsn, self::DB_USER, self::DB_PASS);
    }
}

/*class DB
{

	public function connect($db_host, $db_name, $charset, $db_user, $db_pass, $db_opt)
	{

		if($this->db === null)
		{
			$this->dsn = sprintf("%s:host=%s;dbname=%s;charset=%s",'mysql', $db_host, $db_name, $charset);
			$this->db = new PDO($dsn, $db_user, $db_pass, $db_opt);
		}
		return $this->db;
	}
}
	echo $dsn;*/