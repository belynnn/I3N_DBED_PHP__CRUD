<?php

class View
{
    private $file;
    public function __construct($action)
    {
        $this->file = "View/view_$action.php";
    }
    public function show($data = [])
    {
        if (file_exists($this->file)) {
            extract($data);
            $web_root = "/CRUD-I3N-DBED/";
            require $this->file;
        } else {
            throw new Exception("File '$this->file' doesn't exist.");
        }
    }
}
