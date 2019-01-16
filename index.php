<?php

use core\DB;
use core\Templater;
use models\ArticlesModel;
use models\UserModel;
function __autoload($classname){
    if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php'))
    {
        include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    }
/*    else{
        $msg = 'Не найден файл-модель: ' . __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
        exit($msg);
    }*/
}
session_start();


 //$mUser = new UserModel(DB::connect());

/* Старый index.php
	include_once('m/system.php');
	include_once('m/articles.php');

/*	$params = explode('/', $_GET['cval']);
	$end = count($params)-1;
	print_r($_GET['cval']);
	if($params[$end] === ''){
		unset($params[$end]);
	}
	*/

    $articles = '';
	$base = '';
	$content = '';
	$title = '';
	$inner = '';
	$err404= false;

// ЗАГЛУШКА ПРОВЕРКИ АВТОРИЗАЦИИ
	$isAuth = true; //isAuth();

	$uri = $_SERVER['REQUEST_URI'];
	$uriParts = explode('/',$uri);
	unset($uriParts[0]);
//	$uriParts = array_merge($uriParts1,$uriParts);
	$uriParts = array_values($uriParts);

	$controller = isset($uriParts[0]) && $uriParts[0] !== '' ? $uriParts[0] : 'post';

    try
    {
        switch($controller){
            case 'post':
                $controller = 'Article';
                break;

            case 'user':
                $controller = 'User';
                break;

            default:
                throw new core\Exception\ErrorNotFoundException();
                break;
        }
        $id = false;
        if (isset($uriParts[1]) && is_numeric($uriParts[1]))
        {
            $id = $uriParts[1];
            $uriParts[1] = 'one';
        }

        $action = isset($uriParts[1]) && $uriParts[1] !== '' && !is_numeric($uriParts[1]) ? $uriParts[1] : 'index';
        
        $actionParts = explode('-', $action);
        for($i = 1; $i < count($actionParts); $i++){
            if(!isset($actionParts[$i])){
                continue;
            };

            $actionParts[$i] = ucfirst($actionParts[$i]);
        }
        $action = implode('', $actionParts);
        $action = sprintf('%sAction', $action);

    /*		$action = isset($uriParts[1]) && $uriParts[1] !== '' && is_string($uriParts[1]) ? $uriParts[1] : 'index';
        $action = sprintf('%sAction', $action);
    //	$action =

        if(isset($uriParts[3]) && is_numeric($uriParts[3]))
        {
            $id = $uriParts[3];
        }
        elseif(isset($uriParts[2]) && is_numeric($uriParts[2]))
        {
            $id = $uriParts[2];
        }*/

        if(!$id)
        {
            $id = isset($uriParts[2]) && is_numeric($uriParts[2]) ? $uriParts[2] : false;
        }

        if($id)
        {
            $_GET['id'] = $id;
        }

        $request = new \core\Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION);

        $controller = sprintf('controller\%sController', $controller);
        $controller = new $controller($request);
        $controller->$action();
    } catch (\Exception $e){
        $controller = sprintf('controller\%sController', 'Base');
        $controller = new $controller($request);
        $controller->errorHandler($e->getMessage(), $e->getTraceAsString());
    }
    $controller->render();


/*
	$controller = trim($_GET['c'] ?? 'home');
	//Проверка контроллер есть, контроллер из правильных символов
	if (!check_file("c/$controller.php") || !check_filename($controller)){
		$err404 = true;
	}
	else {
		include_once("c/$controller.php");
	}
	if($err404){
		header ("HTTP/1.1 404 Not Found");
		$title = 'Ошибка 404';
		$inner = template('v_err404');
	}	
	echo template('v_main_post', [
		'content' => $inner,
		'title' => $title,
		'isAuth' => $isAuth,
		'articles' => $articles
	]);*/