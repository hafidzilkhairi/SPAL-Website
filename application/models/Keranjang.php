<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Model{
    private $id;
    private $detailKeranjang = array();
    private $idx = 0;

    public function __construct($id,$nama,$alamat=null,$email,$noHp=null){
        parent::__construct($nama,$alamat,$email,$noHp);
        $this->setId($id);
    }

    /**
     * Get the value of id
     */ 
    public function getDetailKeranjang()
    {
        return $this->detailKeranjang;
    }
    public function setDetailKeranjang($detailKeranjang)
    {
        $this->detailKeranjang = $detailKeranjang;
        return $this;
    }
    public function setSingleDetailKeranjang(Detail $detailKeranjang)
    {
        $this->detailKeranjang[$this->idx] = $detailKeranjang;
        $this->idx = ($this->idx)+1;
        return $this;
    }
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