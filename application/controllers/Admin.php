<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        if($this->session->has_userdata('idAdmin')){
			redirect('http://localhost/SPAL-Website/admin/produk');
		}else{
			redirect('http://localhost/SPAL-Website/admin/signIn');
		}
    }
    
    public function signUp($status = null){
		if(!$this->session->has_userdata('idAdmin')){
			if($status == 'daftar'){
				$this->form_validation->set_rules('username', 'Username', 'required',
					array('required' => '
					<div class="alert alert-danger" role="alert">
					Harap mengisi kolom username
					</div>'));
				$this->form_validation->set_rules('setuju', 'Aggrement', 'required',
					array('required' => '
					<div class="alert alert-danger" role="alert">
					Harap menyetujui kesepakatan
					</div>')
				);
				$this->form_validation->set_rules('password', 'Password Confirmation', 'required',
					array('required' => '
					<div class="alert alert-danger" role="alert">
					Harap mengisi kolom password
					</div>'));
				$this->form_validation->set_rules('email', 'Email', 'required',
					array('required' => '
					<div class="alert alert-danger" role="alert">
					Harap mengisi kolom email
					</div>'));
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('admin/signupV.php');
				}
				else
				{
					$uname = set_value('username');
					$pass = set_value('password');
					$email = set_value('email');
					$this->form_validation->set_rules('email', 'Email', 'callback_callIsUserExist');
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('admin/signupV.php');
					}else{
						$query = $this->db->insert('admin',array(
							'namaAdmin' => $uname,
							'passwordAdmin' => $pass,
							'emailAdmin' => $email
						));
						if($query){
							$this->db->where('emailAdmin',$email);
							$this->db->select('idAdmin');
							if($query = $this->db->get('admin')){
								$this->session->set_userdata('idAdmin', $query->result()[0]->idAdmin);
								$alamat = base_url()+'admin/signIn';
								redirect('http://localhost/SPAL-Website/admin/signIn','location');
							}else{
								$this->form_validation->set_rules('email', 'Email', 'callback_callIsUserExist');
								$this->load->view('admin/signupV.php');
							}
						}else{
							echo 'Tidak berhasil';
						}
					}
				}
			}else{
				$this->load->view('admin/signupV');
			}
		}else{
			redirect('http://localhost/SPAL-Website/admin');
		}
	}

	public function signIn($status = null){
		if($this->session->has_userdata('idAdmin')){
			redirect('http://localhost/SPAL-Website/admin','location');
		}else{
			if($status=='validation'){
				$this->form_validation->set_rules('username', 'Username', 'required',
					array('required' => '
					<div class="alert alert-danger" role="alert">
					Harap mengisi kolom username
					</div>'));
				$this->form_validation->set_rules('password', 'Password Confirmation', 'required',
					array('required' => '
					<div class="alert alert-danger" role="alert">
					Harap mengisi kolom password
					</div>'));
				$this->form_validation->set_rules('username', 'Username', 'callback_validasiUsername');
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/signinV');
				}else{
					redirect('http://localhost/SPAL-Website/admin','location');
				}
			}else{
				$this->load->view('admin/signinV');
			}
		}
	}

	public function signOut(){
		$this->session->unset_userdata('idAdmin');
		redirect('http://localhost/SPAL-Website/admin/signIn','location');
	}

	public function produk($status = null, $idProdukP = null){
		if($this->session->has_userdata('idAdmin')){
			// ###########Tambah Produk##########
			if($status=='tambah'){
				$parameter['judul']="Tambah Produk";
				if($idProdukP == 'upload'){
					$this->form_validation->set_rules('namaProduk', 'Nama Produk', 'required',
						array('required' => '
						<div class="alert alert-danger" role="alert">
						Harap mengisi nama produk
						</div>'));
					$this->form_validation->set_rules('hargaProduk', 'Harga Produk', 'required',
						array('required' => '
						<div class="alert alert-danger" role="alert">
						Harap mengisi harga produk
						</div>'));
					$this->form_validation->set_rules('jumlahProduk', 'Jumlah Produk', 'required',
						array('required' => '
						<div class="alert alert-danger" role="alert">
						Harap mengisi jumlah produk
						</div>'));
					if ($this->form_validation->run() == FALSE){
						$this->load->view('admin/header');
						$this->load->view('admin/tambahProdukV',$parameter);
						$this->load->view('admin/footer');
					}else{
						$data = array(
							'idAdmin' => $this->session->userdata('idAdmin'),
							'namaProduk' => $_POST['namaProduk'],
							'hargaProduk' => $_POST['hargaProduk'],
							'jumlahProduk' => $_POST['jumlahProduk'],
						);
						$this->session->set_flashdata('uploadGambarProduk',1);
						$this->db->insert('produk',$data);
						if(isset($_FILES['gambarProduk'])){
							$this->db->select_max('idProduk','maks');
							$this->db->insert('gambarProduk',array('idProduk'=>$this->db->get('produk')->result()[0]->maks));
							$config['upload_path']          = 'images/produk/';
							$config['allowed_types']        = 'gif|bmp|jpg|png|jpeg';
							
							$this->db->select_max('idGambar','maks');
							$config['file_name'] = $this->db->get('gambarProduk')->result()[0]->maks;
							$extension = pathinfo($_FILES["gambarProduk"]['name'], PATHINFO_EXTENSION);
							$fullpath = $config['upload_path'].$config['file_name'].'.'.$extension;
							if(file_exists($fullpath)){
								unlink($fullpath);
							}
							$this->db->where('idGambar',$config['file_name']);
							$this->db->update('gambarProduk',array('extension'=>$extension));
							$this->load->library('upload',$config);
							if(!$this->upload->do_upload('gambarProduk')){
								$this->session->set_flashdata('uploadGambarProduk',2);
							}
						}
						redirect($this->config->base_url().'admin/tambahProduk');
					}
				}else{
					$this->load->view('admin/header');
					$this->load->view('admin/tambahProdukV',$parameter);
					$this->load->view('admin/footer');
				}
			}else if($status == 'hapus' && $idProdukP != null){
				$this->db->where();
			}else
			// ######Akhir tambah Produk#######
			

			// ########Manajemen Produk########
			{
				$judul['judul'] = 'Manajemen Produk';
				$this->viewTemplate('manajemenProduk',$judul);
			}
		}else{
			redirect($this->config->base_url().'admin/signIn');
		}
	}







	public function validasiUsername($x){
		$uname = set_value('username');
		$pass = set_value('password');
		$this->db->where('namaAdmin',$uname);
		$this->db->where('passwordAdmin',$pass);
		$this->db->select('idAdmin');
		try{
			$query = $this->db->get('admin')->result();
			if(empty($query)){
				$this->form_validation->set_message('validasiUsername', '<div class="alert alert-danger" role="alert">
						Gagal signin, username atau password salah...
						</div>');
				return false;
			}else{
				$this->session->set_userdata('idAdmin',$query[0]->idAdmin);
				return true;
			}
		}catch(Exception $e){
			$this->form_validation->set_message('validasiUsername', '<div class="alert alert-danger" role="alert">
					Gagal signin, terjadi galat pada server...
					</div>');
			return false;
		}
	}

	public function callIsUserExist($x=null){
		if($this->isUserExist(set_value('username'),set_value('email'))){
			return true;
		}else{
			$this->form_validation->set_message('callIsUserExist', '<div class="alert alert-danger" role="alert">
					Gagal mendaftar, data user telah ada....
					</div>');
			return false;
		}
	}

	public function isUserExist($x,$y){
		$this->db->where('namaAdmin',$x);
		$this->db->where('emailAdmin',$y);
		try{
			if(empty($this->db->get('admin')->result())){
				return true;
			}else{
				return false;
			}
		}catch(Exception $e){
			return false;
		}
	}

	public function masalahDatabase($x=null){
		$this->form_validation->set_message('masalahDatabase', '<div class="alert alert-danger" role="alert">
					Gagal mendaftar, terjadi error pada database....
					</div>');
		return false;
	}

	public function viewTemplate($view,$judul){
		$this->load->view('admin/header');
		// $view = 'admin/'+$view;
		$this->load->view('admin/manajemenProduk',$judul);
		$this->load->view('admin/footer');
	}
}
