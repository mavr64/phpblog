<?php

namespace controller;

use core\Request;
use core\Exception\ErrorNotFoundException;

class BaseController 
{
	protected $title;
	protected $content;
	protected $articles;
	protected $request;

	public function __construct(Request $request = null)
	{
	    $this->request = $request;
		$this->title = 'PHP';
		$this->content = '';
		$this->articles = null;
	}

    public function __call($name, $params)
    {
        throw new ErrorNotFoundException();
	}
	
	public function render()
	{
		echo $this->build(
				__DIR__ . '/../views/main.html.php', 
				[
					'content' => $this->content, 
					'title' => $this->title,
					'articles' => $this->articles
				]
			);
	}

    public function errorHandler($message, $trace)
    {
        $this->content = $message;
	}
	
    protected function redirect($uri)
    {
        header(sprintf('Location: %s', $uri));
        die();
	}
	
	protected function build($template, array $params = [])
    {
        extract($params);

        ob_start();
        include $template;
        return ob_get_clean();
    }
}

?>