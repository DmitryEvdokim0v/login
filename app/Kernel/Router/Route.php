<?php

namespace APP\Kernel\Router;

class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private object|array $action
    )
    {}

    public static function get(string $uri, object|array $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post(string $uri, object|array $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): object|array
    {
        return $this->action;
    }
}