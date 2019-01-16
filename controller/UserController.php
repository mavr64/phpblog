<?php
namespace controller;

use models\UserModel;
use core\User;
use core\DB;
use core\DBDriver;
use core\Validator;
use core\Exception\ModelIncorrectValidatorException;

class UserController extends BaseController
{
	public function signUpAction() 
	{
		$errors=[];
		$this->title .= '::Регистрация';
		if ($this->request->isPost()) {
			$mUser = new UserModel(
				new DBDriver(DB::getConnect()),
            	new Validator()
			);
			$user = new User($mUser);
			try {
				$user->signUp($this->request->post());
				$this->redirect('/');
				
			} catch (ModelIncorrectValidatorException $ex) {
				$errors = $ex->getErrors();
			}
		}

	    $this->content = $this->build(
	    							__DIR__ . '/../views/sign-up.html.php', 
	    							[
	    								'errors' => $errors,
	    								/*'articles' => $this->articles,
	    								'isAuth' => $isAuth*/
	    							]
	    							);
	}
}