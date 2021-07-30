<?php

require_once 'Personne.php';
require_once 'Compte.php';

class Epargne extends Compte
{
    protected $dateDernierRetrait;

    public function __construct(string $numero, float $solde, Personne $titulaire)
    {
        parent::__construct($numero, $solde, $titulaire);
    }

    // ------------ Date dernier retrait
    public function getDateDernierRetrait()
    {
        return $this->dateDernierRetrait;
    }
    public function setDateDernierRetrait(DateTime $date)
    {
        $this->dateDernierRetrait = $date;
    }

    // Override de la fonction retrait.
    public function retrait($montant)
    {
        $ancientSolde = $this->solde;
        parent::retrait($montant);

        if ($this->solde != $ancientSolde) {
            $this->dateDernierRetrait = new DateTime();
        }
    }
}
