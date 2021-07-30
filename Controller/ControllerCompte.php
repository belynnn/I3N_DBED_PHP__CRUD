<?php

require_once 'Framework/Controller.php';
require_once 'Framework/View.php';
require_once 'Model/Personne.php';
require_once 'Model/Compte.php';

class ControllerCompte extends Controller
{
    public function index()
    {
        $this->list();
    }
    public function list()
    {
        $list = Compte::getAll();

        $view = new View("compte_list");
        $view->show(["list" => $list]);
    }

    public function edit()
    {
        if (isset($_GET["param"])) {
            $compte = Compte::getOneByID($_GET["param"]);

            if ($compte != null) {
                $view = new View("compte_create");
                $view->show([
                    "title" => "Edit account : ",
                    "action" => "edit_one/" . $compte->getNumero(),
                    "person" => null,
                    "titulaire" => $compte->getTitulaire(),
                    "numero" => $compte->getNumero()
                ]);
                return;
            }
        }
        $this->redirect("compte");
    }

    public function create()
    {
        $titulaire = null;
        $action = "add/";
        if (isset($_GET["param"])) {
            $titulaire = Personne::getOneByID($_GET["param"]);
            $action .= $titulaire ? $titulaire->id : "";
        }
        $persons = Personne::getAll();
        $view = new View(("compte_create"));
        $view->show([
            "title" => "Create account : ",
            "action" => $action,
            "persons" => $persons,
            "titulaire" => $titulaire,
            "numero" => ""
        ]);
    }
    public function add()
    {
        if (isset($_POST["numero"]) && $_POST["numero"] != "") {
            $titulaire = null;
            if (isset($_GET["param"])) {
                $titulaire = Personne::getOneByID($_GET["param"]);
            } elseif (isset($_POST["titulaire_id"]) && $_POST["titulaire_id"] != "") {
                $titulaire = Personne::getOneByID($_POST["titulaire_id"]);
            }
            if ($titulaire != null) {
                $compte = new Compte($_POST["numero"], 0.0, $titulaire);
                $compte->update();
            }
        }
        $this->redirect("compte");
    }

    public function edit_one()
    {
        if (isset($_GET["param"]) && isset($_POST["numero"]) && $_POST["numero"] != "") {
            $compte = Compte::getOneByID($_GET["numero"]);
            if ($compte != null) {
                $compte->setNumero($_POST["numero"]);
                $compte->update();
            }
        }
        $this->redirect("compte");
    }

    public function delete()
    {
        if (isset($_GET["param"])) {
            $compte = Compte::getOneByID($_GET["param"]);
            if ($compte != null) {
                $compte->delete();
            }
        }
        $this->redirect("compte");
    }

    public function info()
    {
        if (isset($_GET["param"])) {
            $compte = Compte::getOneByID($_GET["param"]);
            if ($compte != null) {
                // $titulaire = Compte::getOneByID($_GET["param"])->getTitulaire();
                $view = new View("compte_info");
                $view->show(["compte" => $compte]);
            } else {
                throw new Exception("An error has occurred, we apologize.");
            }
        } else {
            $this->redirect("compte");
        }
    }
}
