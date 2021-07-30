<?php

require_once 'Personne.php';
require_once 'Framework/Model.php';

class Compte extends Model
{
    private $numero;
    private $solde;
    private $titulaire;

    public function __construct(string $numero, float $solde, Personne $titulaire)
    {
        $this->numero = $numero;
        $this->solde = $solde;
        $this->titulaire = $titulaire;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($value)
    {
        if (is_string($value)) {
            $this->numero = $value;
        }
    }

    public function getSolde()
    {
        return $this->solde;
    }

    public function getTitulaire()
    {
        return $this->titulaire;
    }

    public function setTitulaire(Personne $value)
    {
        $this->titulaire = $value;
    }

    public function retrait($montant)
    {
        $this->_retrait($montant, 0.0);
    }

    protected function _retrait($montant, $ligneCredit)
    {
        if (is_numeric($montant)) {
            if ($montant <= 0) {
                return;
            }

            if ($this->solde - $montant < -$ligneCredit) {
                return;
            }

            $this->solde -= $montant;
        }
    }

    public function depot($montant)
    {
        if (is_numeric($montant)) {
            if ($montant <= 0) {
                return;
            }

            $this->solde += $montant;
        }
    }

    public static function getAll()
    {
        $query = self::execute("SELECT * from compte", []);
        $data = $query->fetchAll();
        $results = [];

        foreach ($data as $row) {
            $results[] = new Compte($row["numero"], $row["solde"], Personne::getOneByID($row["titulaire"]));
        }

        return $results;
    }

    public static function getOneByID($numero)
    {
        $query = self::execute(
            "SELECT * FROM compte WHERE numero=:numero",
            ["numero" => $numero]
        );

        if ($query->rowCount() != 0) {
            $data = $query->fetch();
            $result = new Compte($data["numero"], $data["solde"], Personne::getOneByID($data["titulaire"]));
            return $result;
        }
        return null;
    }

    public static function getComptesByTitulaire(Personne $titulaire)
    {
        $query = self::execute("SELECT * from compte WHERE titulaire=:titulaire", ["titulaire" => $titulaire->id]);
        $data = $query->fetchAll();
        $results = [];
        foreach ($data as $row) {
            $results[] = new Compte($row["numero"], $row["solde"], Personne::getOneByID($row["titulaire"]));
        }
        return $results;
    }

    public function update()
    {
        if (self::getOneByID($this->numero)) {
            self::execute(
                "UPDATE compte SET solde=:solde, titulaire=:titulaire WHERE numero=:numero",
                ["solde" => $this->solde, "titulaire" => $this->titulaire->id, "numero" => $this->numero]
            );
        } else {
            self::execute(
                "INSERT INTO compte(solde, titulaire, numero) VALUES(:solde, :titulaire, :numero)",
                ["solde" => $this->solde, "titulaire" => $this->titulaire->id, "numero" => $this->numero]
            );
        }
    }

    public function delete()
    {
        if (self::getOneByID($this->numero)) {
            self::execute("DELETE FROM compte WHERE numero=:numero", ["numero" => $this->numero]);
        }
    }
}
