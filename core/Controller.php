<?php

namespace core;

abstract class Controller
{
    public string|false $layout = 'main';

    public function render(string $filename, array $data): bool
    {
        ob_start();
        extract($data);

        require (ROOT . '/views/' . $filename . '.php');
        $content = ob_get_clean();

        if ($this->layout == false) {
            echo $content;
        } else {
            require(ROOT . '/views/' . $this->layout . '.php');
        }

        return true;
    }

    public function returnJSON(mixed $data, ?int $http_code = null): bool
    {
        header('Content-type: application/json;');
        echo json_encode($data);

        if ($http_code) {
            http_response_code($http_code);
        }
        return true;
    }
}