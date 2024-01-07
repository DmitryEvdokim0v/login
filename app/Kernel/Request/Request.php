<?php

namespace APP\Kernel\Request;

class Request
{
    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies
    )
    {}

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }

    public function uri()
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    protected function getQuery()
    {
        $queryString = $_SERVER['QUERY_STRING'];
        $result = [];
        parse_str($queryString, $result);

        return $result;
    }
}