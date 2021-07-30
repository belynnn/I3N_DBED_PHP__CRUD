<?php

require_once 'Compte.php';

class Banque
{
    protected $nom;
    protected $comptes;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
        $this->comptes = [];
    }

    // ----------------- Nom ----------------
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($value)
    {
        $this->nom = $value;
    }

    // ------------ Compte ------------------
    public function addCompte(Compte $compte)
    {
        $this->comptes[$compte->getNumero()] = $compte;
    }
    public function deleteCompte(Compte $numero)
    {
        unset($this->comptes[$numero]);
    }
}
