<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/models/Orang.php';
class Supplier extends Orang{
    private $id;

    public function __construct(){
    }

    public function init($id,$nama,$alamat=null,$email,$noHp=null){
        parent::init($nama,$alamat,$email,$noHp);
        $this->setId($id);
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