<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart extends CI_Model{
    private $id;
    private $idAdmin;
    private $nama;
    private $harga;
    private $jumlah;

    public function init($id,$idAdmin, $nama, $harga, $jumlah){
        $this->setId($id);
        $this->setNama($nama);
        $this->setHarga($harga);
        $this->setJumlah($jumlah);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nama
     */ 
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set the value of nama
     *
     * @return  self
     */ 
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get the value of harga
     */ 
    public function getHarga()
    {
        return $this->harga;
    }

    /**
     * Set the value of harga
     *
     * @return  self
     */ 
    public function setHarga($harga)
    {
        $this->harga = $harga;

        return $this;
    }

    /**
     * Get the value of jumlah
     */ 
    public function getJumlah()
    {
        return $this->jumlah;
    }

    /**
     * Set the value of jumlah
     *
     * @return  self
     */ 
    public function setJumlah($jumlah)
    {
        $this->jumlah = $jumlah;

        return $this;
    }
}