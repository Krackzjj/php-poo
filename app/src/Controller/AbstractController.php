<?php

namespace App\Controller;

abstract class AbstractController
{
    public function __construct(string $action, array $params = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!is_callable([$this, $action])) {
            throw new \RuntimeException("La methode $action n'est pas disponible dans ce controller");
        }
        call_user_func_array([$this, $action], $params);
    }

    public function render(string $view, array $args = [], string $title = "Document")
    {
        $view = dirname(__DIR__, 2) . '/views/' . $view . '.php';
        $base = dirname(__DIR__, 2) . '/views/base.php';

        ob_start();
        foreach ($args as $key => $value) {
            ${$key} = $value;
        }

        unset($args);

        require_once $view;
        $_pageContent = ob_get_clean();
        $_pageTitle = $title;


        require_once $base;

        exit;
    }
    public function renderJSON(array $content): void
    {
        header('content-type: application/json');
        echo json_encode($content);
        exit;
    }
}
