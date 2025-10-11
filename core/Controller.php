<?php

namespace core;

abstract class Controller
{
    public $layout = 'main';

    public function render($filename, array $data)
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

    public function returnJSON($data, $http_code = null)
    {
        header('Content-type: application/json;');
        echo json_encode($data);

        if ($http_code) {
            http_response_code($http_code);
        }
        return true;
    }
}