<?php
namespace controller;

use models\ErrorModel;
use core\DB;

class PagesController extends BaseController
{
	public function actionErr404() 
	{
		$this->title .= '::ОШИБКА 404';
		
//		$mError = new ErrorModel(DB::connect());
//		$this->articles = $mArticle->getAll();
	    $this->content = $this->build(__DIR__ . '/../views/error.html.php', []);
	    header("HTTP/1.1 404 Not Found");
	}
}