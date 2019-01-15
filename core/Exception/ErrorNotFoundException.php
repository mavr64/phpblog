<?php
/**
 * Copyright (c) 13.01.19 1:41.г. Саратов - year. Все права защищены.
 */

namespace core\Exception;


class ErrorNotFoundException extends \Exception
{
    public function __construct($message = 'Page not found.', $code = 404)
    {
        parent::__construct($message, $code);
    }
}