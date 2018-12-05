<?php defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Orang extends CI_Model{
    private $nama;
    private $alamat;
    private $email;
    private $noHp;

    public function __construct(){
    }

    public function init($nama,$alamat,$email,$noHp){
        $this->setNama($nama);
        $this->setAlamat($alamat);
        $this->setEmail($email);
        $this->setNoHp($noHp);
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
     * Get the value of alamat
     */ 
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * Set the value of alamat
     *
     * @return  self
     */ 
    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of noHp
     */ 
    public function getNoHp()
    {
        return $this->noHp;
    }

    /**
     * Set the value of noHp
     *
     * @return  self
     */ 
    public function setNoHp($noHp)
    {
        $this->noHp = $noHp;

        return $this;
    }
}