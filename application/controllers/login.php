<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        //load library form validasi
		$this->load->library('form_validation');
        //load model kasir
		$this->load->model('kasir');
	}

	public function index()
	{
		if($this->kasir->logged_id())
		{
    //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			if ($this->session->userdata("id_level") == '1'){
				redirect('admin');
			}elseif($this->session->userdata("id_level") == '2'){
				redirect('waiter');
			}elseif($this->session->userdata("id_level") == '3'){
				redirect('kasir1');
			}elseif($this->session->userdata("id_level") == '4'){
				redirect('owner');
			}elseif($this->session->userdata("id_level") == '5'){
				redirect('pelanggan');
			}
		}else{

    //jika session belum terdaftar

    //set form validation
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

             //set message form validation
			$this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
				<div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

             //cek validasi
			if ($this->form_validation->run() == TRUE) {

    //get data dari FORM
				$username = $this->input->post('username', TRUE);
				$password = $this->input->post('password', TRUE);

             //checking data via model
				$checking = $this->kasir->check_login('user', array('username' => $username), array('password' => $password));

             //jika ditemukan, maka create session
				if ($checking != FALSE) {
					foreach ($checking as $apps) {

						$session_data = array(
							'id_user'   => $apps->id_user,
							'user_name' => $apps->username,
							'user_pass' => $apps->password,
							'user_nama' => $apps->nama_user,
							'id_level' => $apps->id_level
						);
                     //set session userdata
						$this->session->set_userdata($session_data);
						if ($this->session->userdata("id_level") == '1'){
							redirect('admin');
						}elseif($this->session->userdata("id_level") == '2'){
							redirect('waiter');
						}elseif($this->session->userdata("id_level") == '3'){
							redirect('kasir1');
						}elseif($this->session->userdata("id_level") == '4'){
							redirect('owner');
						}elseif($this->session->userdata("id_level") == '5'){
							redirect('pelanggan');
						}
					}
				}else{

					$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
					<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
					$this->load->view('login', $data);
				}

			}else{

				$this->load->view('login');
			}

		}

	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	

}
