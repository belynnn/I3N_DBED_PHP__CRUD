<?php

abstract class Controller
{
    public abstract function index();

    public function redirect($controller = "", $action = "index", $id = "", $statusCode = 303)
    {
        $web_root = "/CRUD-I3N-DBED/";
        $default_controller = "Personne";
        if ($controller == "") {
            $controller = $default_controller;
        }
        header("Location: " . $web_root . $controller . "/" . $action . "/" . $id, true, $statusCode);
        die();
    }
}
