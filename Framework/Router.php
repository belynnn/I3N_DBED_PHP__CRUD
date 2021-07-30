<?php

require_once 'Tools.php';

class Router
{
    public function sanitize_all_array($array)
    {
        $copy = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $copy[$key] = $this->sanitize_all_array($value);
            } else {
                $copy[$key] = Tools::sanitize($value);
            }
        }
        return $copy;
    }

    public function sanitize_all_input()
    {
        $_POST = $this->sanitize_all_array($_POST);
        $_GET = $this->sanitize_all_array($_GET);
    }

    private function get_controller()
    {
        //Set default controller
        $controller_name = "Personne";

        if (isset($_GET["controller"]) && $_GET["controller"] != "") {
            $controller_name = $_GET["controller"];
        }

        $controller_class_name = "Controller" . ucfirst(strtolower($controller_name));

        $filename = "Controller/$controller_class_name.php";
        if (file_exists($filename)) {
            require_once $filename;
            if (class_exists($controller_class_name)) {
                //exemple: return new ControllerPersonne();
                return new $controller_class_name();
            }
        } else {
            throw new Exception(("Controller '$controller_name' doesn't exist."));
        }
    }

    private function call_action($controller)
    {
        $action_name = "index";
        if (isset($_GET["action"]) && $_GET["action"] != "") {
            $action_name = $_GET["action"];
        }
        if (method_exists($controller, $action_name)) {
            $controller->$action_name();
        } else {
            throw new Exception("Action '$action_name' doesn't exist in controller.");
        }
    }

    public function route()
    {
        try {
            // $i = 10 / 0;
            $this->sanitize_all_input();

            if (isset($_GET["param"]) && $_GET["param"] == "") {
                unset($_GET["param"]);
            }

            $controller = $this->get_controller();
            $this->call_action($controller);

            // throw new Exception("TEst exception");
        } catch (Exception $e) {
            Tools::abort($e->getMessage());
        }
    }
}
