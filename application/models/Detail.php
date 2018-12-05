<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Model{
    private $id;
    private $produk;

    public function __construct($id,$produk){
        $this->setProduk($produk);
        $this->setId($id);
    }

    public function getProduk()
    {
        return $this->produk;
    }
    public function setProduk($produk)
    {
        $this->produk = $produk;
        return $this;
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
}