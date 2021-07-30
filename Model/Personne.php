<?php

require_once 'Framework/Model.php';
// CREATE TABLE personne ( personne_id INT NOT NULL AUTO_INCREMENT, nom VARCHAR(25), prenom VARCHAR(25), dateNaiss DATETIME, PRIMARY KEY(personne_id) )

class Personne extends Model
{
    public $id;
    public $nom;
    public $prenom;
    public $dateNaiss;

    public function __construct($id, $nom, $prenom, $dateNaiss)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaiss = $dateNaiss;
    }

    public static function getAll()
    {
        $query = self::execute("SELECT * from personne", []);
        $data = $query->fetchAll();
        $results = [];

        foreach ($data as $row) {
            $results[] = new Personne($row["personne_id"], $row["nom"], $row["prenom"], new DateTime($row["dateNaiss"]));
        }

        return $results;
    }

    public static function getOneByID($id)
    {
        $query = self::execute(
            "SELECT * FROM personne WHERE personne_id=:personne_id",
            ["personne_id" => $id]
        );

        if ($query->rowCount() != 0) {
            $data = $query->fetch();
            $result = new Personne($data["personne_id"], $data["nom"], $data["prenom"], new DateTime($data["dateNaiss"]));
            return $result;
        }
        return null;
    }

    public function convertDate()
    {
        return date("Y-m-d", $this->dateNaiss->getTimestamp());
    }

    public function update()
    {
        if (self::getOneByID($this->id)) {
            self::execute(
                "UPDATE personne SET nom=:nom, prenom=:prenom, dateNaiss=:dateNaiss WHERE personne_id=:personne_id",
                [
                    "nom" => $this->nom, "prenom" => $this->prenom, "dateNaiss" => date("Y-m-d", $this->dateNaiss->getTimestamp()),
                    "personne_id" => $this->id
                ]
            );
        } else {
            self::execute(
                "INSERT INTO personne(nom, prenom, dateNaiss) VALUES(:nom, :prenom, :dateNaiss)",
                ["nom" => $this->nom, "prenom" => $this->prenom, "dateNaiss" => date("Y-m-d", $this->dateNaiss->getTimestamp())]
            );
            $this->id = self::lastInsertedID();
        }
    }

    public function delete()
    {
        if (self::getOneByID($this->id)) {
            self::execute("DELETE FROM personne WHERE personne_id=:personne_id", ["personne_id" => $this->id]);
        }
    }

    public function __toString()
    {
        return "$this->nom $this->prenom";
    }
}
