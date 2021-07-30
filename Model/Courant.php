<?php

require_once 'Personne.php';
require_once 'Compte.php';

class Courant extends Compte
{
    protected $ligneCredit;


    public function __construct(string $numero, float $solde = 0.0, float $ligneCredit = 100.0, Personne $titulaire)
    {
        parent::__construct($numero, $solde, $titulaire);

        $this->ligneCredit = $ligneCredit;
    }

    // ------------- Ligne de crédit ----------------
    public function getLigneCredit()
    {
        return $this->ligneCredit;
    }
    public function setLigneCredit($value)
    {
        if (is_numeric($value)) {
            if ($value < 0) {
                return;
            }
            $this->ligneCredit = $value;
        }
    }


    // -------------- Retrait -----------------
    public function retrait($montant)
    {
        if (is_numeric($montant)) {
            if ($montant <= 0) {
                return;
            }
            if (($this->solde - $montant) < -$this->ligneCredit) {
                return;
            }
            $this->solde -= $montant;
        }
    }
}
