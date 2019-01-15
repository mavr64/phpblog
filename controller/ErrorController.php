<?php
namespace controller;

use models\ErrorModel;
use core\DB;

class ErrorController extends BaseController
{
	public function actionIndex() 
	{
		$this->title .= '::Список статей';
		
		$mError = new ErrorModel(DB::getConnect());
//		$this->articles = $mArticle->getAll();
	    $this->content = $this->build(__DIR__ . '/../views/error.html.php', []);
	}
}
?>