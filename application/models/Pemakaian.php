<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemakaian extends CI_Model{
    private $idSparepart;
    private $jumlah = 0;

    public function __construct($idSparepart){
        $this->setId($idSparepart);
    }

    public function getJumlah()
    {
        return $this->jumlah;
    }
    public function setJumlah($jumlah)
    {
        $this->jumlah = $jumlah;
        return $this;
    }
    /**
     * Get the value of id
     */ 
    public function getIdSparepart()
    {
        return $this->idSparepart;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdSparepart($idSparepart)
    {
        $this->idSparepart = $idSparepart;

        return $this;
    }
}