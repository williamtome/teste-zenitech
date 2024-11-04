<?php

namespace Williamtome\App\Controllers;

class BaseController
{
    protected function render(string $view, array $data = [])
    {
        extract($data);

        $viewPath = __DIR__ . '/../views/';

        ob_start();

        require_once $viewPath . $view . '.php';

        return ob_get_clean();
    }
}
