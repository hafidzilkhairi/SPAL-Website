<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller{
    public function index(){
        try{
            $this->load->model('Pembeli');
            $this->Admin->init(1,'sa','sa','sa','sa');
            $saya['namaAdmin'] = $this->Pembeli->getNama();
            $saya['idAdmin'] = $this->Pembeli->getId();
            foreach($saya as $dia){
                echo $dia;
            }
        }catch(Exception $e){
            echo "Error...";
        }
    }
}

?>