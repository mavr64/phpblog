<?php
/**
 * Copyright (c) 28.12.18 0:43.г. Саратов - year. Все права защищены.
 */


namespace core;


class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    private $get;
    private $post;
    private $server;
    private $cookie;
    private  $file;
    private $session;

    public function __construct($get, $post, $server, $cookie, $file, $session)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->cookie = $cookie;
        $this->file = $file;
        $this->session = $session;
    }

    public function get($key = null)
    {
        return $this->getArr($this->get,$key);
    }

    public function post($key = null)
    {
        return $this->getArr($this->post,$key);
    }

    public function server($key = null)
    {
        return $this->getArr($this->server,$key);
    }

    public function cookie($key = null)
    {
        return $this->getArr($this->cookie,$key);
    }

    public function file($key = null)
    {
        return $this->getArr($this->file,$key);
    }

    public function session($key = null)
    {
        return $this->getArr($this->session,$key);
    }

    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_POST;
    }

    private function getArr(array $arr, $key = null)
    {
        if (!$key){
            return $arr;
        }
        if (isset($arr[$key]))
        {
            return $arr[$key];
        }
        return null;
    }
}