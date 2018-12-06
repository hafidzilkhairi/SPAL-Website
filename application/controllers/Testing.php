<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller{
    public function index(){
        
    }
    public function logout(){
        $expected_result = null;
        $result = $_SESSION['idAdmin'];
        $this->load->library('unit_test');
        $this->unit->run($result, $expected_result, 'Logout');
        echo $this->unit->report();
    }
}

?>