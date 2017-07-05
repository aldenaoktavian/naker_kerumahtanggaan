<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('user_model');
		$this->load->model('user_category_model');
    }

	public function index()
	{
		if(check_privilege('user', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "User";
		$data['menu_title'] = "User - List Data";

		$this->load->view('user/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('user', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if($search != ''){
			$data['all_user'] = $this->user_model->data_user($limit, $offset, $search);
			$all_pages = $this->user_model->count_all_user($search);
		} else{
			$data['all_user'] = $this->user_model->data_user($limit, $offset);
			$all_pages = $this->user_model->count_all_user();
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('user/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('user', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Add User";
		$data['menu_title'] = "User - Add User";

		$post = $this->input->post();
		if($post){
			$data_user = array(
					'user_category_id'	=> $post['user_category_id'],
					'fullname'	=> $post['fullname'],
					'username'	=> $post['username'],
					'email'	=> $post['email'],
					'password'	=> md5($post['password']),
					'created'		=> date('Y-m-d H:i:s'),
					'create_by'		=> $_SESSION['login']['id_user']
				);
			$add_user = $this->user_model->add_user($data_user);
			if($add_user != 0){
				$_SESSION['user']['message_color'] = "green";
				$_SESSION['user']['message'] = "Berhasil menambahkan User";
				redirect('user');
			} else{
				$_SESSION['user']['message_color'] = "red";
				$_SESSION['user']['message'] = "Gagal menambahkan User. Silahkan coba kembali nanti.";
				redirect('user');
			}
		}

		$data['all_user_category'] = $this->user_category_model->all_user_category();

		$this->load->view('user/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('user', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Edit User";
		$data['menu_title'] = "User - Edit User";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_user = array(
					'user_category_id'	=> $post['user_category_id'],
					'fullname'	=> $post['fullname'],
					'username'	=> $post['username'],
					'email'	=> $post['email'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_user = $this->user_model->update_user($id, $data_user);
			if($update_user == TRUE){
				$_SESSION['user']['message_color'] = "green";
				$_SESSION['user']['message'] = "Berhasil edit data User";
				redirect('user');
			} else{
				$_SESSION['user']['message_color'] = "red";
				$_SESSION['user']['message'] = "Gagal edit data User. Silahkan coba kembali nanti.";
				redirect('user');
			}
		} else{
			$data['detail_user'] = $this->user_model->detail_user($id);
		}

		$data['all_user_category'] = $this->user_category_model->all_user_category();

		$this->load->view('user/edit', $data);
	}

	public function delete($id)
	{
		if(check_privilege('user', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}

		$delete_user_category = $this->user_model->delete_user($id);

		if($delete_user_category == TRUE){
			$_SESSION['user']['message_color'] = "green";
			$_SESSION['user']['message'] = "Berhasil hapus data User";
			redirect('user');
		} else{
			$_SESSION['user']['message_color'] = "red";
			$_SESSION['user']['message'] = "Gagal hapus data User. Silahkan coba kembali nanti.";
			redirect('user');
		}
	}

	public function account()
	{
		$data['title'] = "Account";
		$data['menu_title'] = "Account - Edit Account";

		$post = $this->input->post();
		if($post){
			$data_edit = array(
					'fullname'	=> $post['fullname'],
					'username'	=> $post['username'],
					'email'	=> $post['email'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_user = $this->user_model->update_user(md5($this->session->login['id_user']), $data_edit);
			if($update_user == TRUE){
				$data['message'] = "Berhasil edit data account.";
			} else{
				$data['message'] = "Gagal edit data account. Silahkan coba kembali nanti.";
			}
		}
		$data['detail_user'] = $this->user_model->detail_user(md5($this->session->login['id_user']));

		$this->load->view('account', $data);
	}

	public function setting()
	{
		$data['title'] = "Setting";
		$data['menu_title'] = "Setting - Edit Setting";

		$post = $this->input->post();
		if($post){
			$check_user_password = $this->user_model->check_user_password($this->session->login['id_user'], md5($post['old_pass']));
			if($check_user_password == TRUE){
				if($post['new_pass'] == $post['confirm_new_pass']){
					$data_pass = array(
							'password'	=> md5($post['new_pass'])
						);
					$update_user = $this->user_model->update_user(md5($this->session->login['id_user']), $data_pass);
					if($update_user == TRUE){
						$data['message'] = "Berhasil merubah setting.";
					} else{
						$data['message'] = "Gagal merubah setting. Silahkan coba kembali nanti.";
					}
				} else{
					$data['message'] = "Password Baru dan Konfirmasi Password Baru tidak cocok";
				}
			} else{
				$data['message'] = "Password Lama tidak sesuai.";
			}
		}

		$this->load->view('setting', $data);
	}
}
