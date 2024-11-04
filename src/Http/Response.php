<?php

namespace Williamtome\App\Http;

class Response
{
    public static function get(array $data = [], int $status = 200): array
    {
        http_response_code($status);
        return $data;
    }
}
