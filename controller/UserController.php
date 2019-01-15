<?php
namespace controller;

use models\ArticlesModel;
use core\DB;
use core\DBDriver;
use core\Validator;
use core\Exception\ModelIncorrectValidatorException;

class ArticleController extends BaseController
{
	public function indexAction() 
	{
		$this->title .= '::Список статей';
		
		$mArticle = new ArticlesModel(
		    new DBDriver(DB::getConnect()),
            new Validator()
        );
		$this->articles = $mArticle->getAll();
	    $this->content = $this->build(
	    							__DIR__ . '/../views/articles.html.php', 
	    							[
	    								'title' => $title,
	    								'articles' => $this->articles,
	    								'isAuth' => $isAuth
	    							]
	    							);
	}
	
	public function oneAction()
	{
		$id = $this->request->get('id');

        $mArticle = new ArticlesModel(
            new DBDriver(DB::getConnect()),
            new Validator()
        );
        $this->articles = $mArticle->getOneById($id);
        if(!$this->articles){
            // 404
        }
        $this->title .= '::' . $this->articles['title'];
//        echo '<br />' . $this->articles['title'] . $this->title;
		$this->content = $this->build(
			__DIR__ . '/../views/onearticle.html.php',
			[
                'id_article' => $this->articles['id_article'],
			    'title' => $this->title,
				'content' => $this->articles['content'],
				'dt' => $this->articles['dt']
			]
		);
	}

    /**
     * @return null
     */
    public function addAction()
    {
        $this->title .= '::Добавление статьи';
        $tmp = $this->request->post('title');

        if ($this->request->isPost())
        {
            $mArticle = new ArticlesModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
            try
            {
                $id = $mArticle->add([
                    'title' => $this->request->post('title'),
                    'content' => $this->request->post('content'),
                    'id_user' => '1'
                ]);
                $this->redirect(sprintf('/post/%s', $id));
            } catch (ModelIncorrectValidatorException $e)
            {
                var_dump($e->getErrors());
                die;
            }

        }

        $this->content = $this->build(
            __DIR__ . '/../views/addarticle.html.php',
            [
                'title' => $this->title,
                'content' => $this->articles['content'],
            ]
        );
    }

    public function editAction()
    {
        $this->title .= '::Правка статьи';
        $id = $this->request->get('id');

        if ($this->request->isPost())
        {
            $mArticle = new ArticlesModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
            $id = $mArticle->edit([
                'title' => $this->request->post('title'),
                'content' => $this->request->post('content'),
                'dt_ed' => 'now()',
                'id' => $id
            ], "id_article = :id");
            $this->redirect(sprintf('/post/one/%s', $id));
        }

        $this->content = 'Форма ввода полей статьи';
    }
}