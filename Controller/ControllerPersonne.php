<?php

require_once 'Framework/Controller.php';
require_once 'Framework/View.php';
require_once 'Model/Personne.php';
require_once 'Model/Compte.php';

class ControllerPersonne extends Controller
{
    public function index()
    {
        $this->list();
    }
    public function list()
    {
        $list = Personne::getAll();

        $view = new View("personne_list");
        $view->show(["list" => $list]);
    }

    public function edit()
    {
        if (isset($_GET["param"])) {
            $person = Personne::getOneByID($_GET["param"]);
        } else {
            $person = new Personne(0, "", "", new DateTime());
        }
        $view = new View("personne_create");
        $view->show(["title" => "Edit person : ", "action" => "edit_one/$person->id", "person" => $person]);
    }

    public function info()
    {
        if (isset($_GET["param"])) {
            $person = Personne::getOneByID($_GET["param"]);
            if ($person != null) {
                $compte = Compte::getComptesByTitulaire($person);
                $view = new View("personne_info");
                $view->show(["list" => $compte, "person" => $person]);
            } else {
                throw new Exception("An error has occurred, we apologize.");
            }
        } else {
            $this->redirect("personne");
        }
    }

    public function create()
    {
        $person = new Personne(0, "", "", new DateTime());
        $view = new View("personne_create");
        $view->show(["title" => "Create person : ", "action" => "add/", "person" => $person]);
    }

    public function add()
    {
        $this->update_personne(0);
    }

    public function edit_one()
    {
        if (isset($_GET["param"])) {
            $this->update_personne($_GET["param"]);
        } else {
            $this->redirect("personne");
        }
    }

    private function update_personne($id)
    {
        if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["datenaiss"])) {
            if ($_POST["nom"] != "" && $_POST["prenom"] != "" && $_POST["datenaiss"] != "") {
                $person = new Personne($id, $_POST["nom"], $_POST["prenom"], new DateTime($_POST["datenaiss"]));
                $person->update();
            }
        }
        $this->redirect("personne");
    }

    public function delete()
    {
        if (isset($_GET["param"])) {
            $person = Personne::getOneByID($_GET["param"]);
            if ($person != null) {
                $person->delete();
            }
        }
        $this->redirect("personne");
    }
}
