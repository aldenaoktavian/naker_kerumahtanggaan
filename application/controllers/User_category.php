<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_category extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('user_category_model');
    }

	public function index()
	{
		if(check_privilege('user_category', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "User Category";
		$data['menu_title'] = "User Category - List Data";

		$this->load->view('user_category/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('user_category', 'is_view') != TRUE){
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
			$data['all_user_category'] = $this->user_category_model->data_user_category($limit, $offset, $search);
			$all_pages = $this->user_category_model->count_all_user_category($search);
		} else{
			$data['all_user_category'] = $this->user_category_model->data_user_category($limit, $offset);
			$all_pages = $this->user_category_model->count_all_user_category();
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('user_category/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('user_category', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Add User Category";
		$data['menu_title'] = "User Category - Add User Category";

		$post = $this->input->post();
		if($post){
			$data_user_category = array(
					'category_name'	=> $post['category_name'],
					'created'		=> date('Y-m-d H:i:s'),
					'create_by'		=> $_SESSION['login']['id_user']
				);
			$add_user_category = $this->user_category_model->add_user_category($data_user_category);
			if($add_user_category != 0){
				$_SESSION['user_category']['message_color'] = "green";
				$_SESSION['user_category']['message'] = "Berhasil menambahkan user category";
				redirect('user_category');
			} else{
				$_SESSION['user_category']['message_color'] = "red";
				$_SESSION['user_category']['message'] = "Gagal menambahkan user category. Silahkan coba kembali nanti.";
				redirect('user_category');
			}
		}

		$this->load->view('user_category/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('user_category', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Edit User Category";
		$data['menu_title'] = "User Category - Edit User Category";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_user_category = array(
					'category_name'	=> $post['category_name'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_user_category = $this->user_category_model->update_user_category($id, $data_user_category);
			if($update_user_category == TRUE){
				$_SESSION['user_category']['message_color'] = "green";
				$_SESSION['user_category']['message'] = "Berhasil edit data user category";
				redirect('user_category');
			} else{
				$_SESSION['user_category']['message_color'] = "red";
				$_SESSION['user_category']['message'] = "Gagal edit data user category. Silahkan coba kembali nanti.";
				redirect('user_category');
			}
		} else{
			$data['detail_user_category'] = $this->user_category_model->detail_user_category($id);
		}

		$this->load->view('user_category/edit', $data);
	}

	public function delete($id)
	{
		if(check_privilege('user_category', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}

		$delete_user_category = $this->user_category_model->delete_user_category($id);

		if($delete_user_category == TRUE){
			$_SESSION['user_category']['message_color'] = "green";
			$_SESSION['user_category']['message'] = "Berhasil hapus data user category";
			redirect('user_category');
		} else{
			$_SESSION['user_category']['message_color'] = "red";
			$_SESSION['user_category']['message'] = "Gagal hapus data user category. Silahkan coba kembali nanti.";
			redirect('user_category');
		}
	}

	public function privileges($id)
	{
		if(check_privilege('user_category', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "User Category Privileges";
		$data['menu_title'] = "User Category - Privileges";
		$data['id'] = $id;
		$user_category_id = db_get_one_data('id', 'user_categories', array('md5(id)'=>$id));
		$all_priv_modules = $this->user_category_model->all_priv_modules($user_category_id);

		$post = $this->input->post();
		if($post){
			foreach ($all_priv_modules as $module) {
				if(isset($post[$module['module_name']])){
					$priv_module = $post[$module['module_name']];
					$data_priv = array(
							'module_id'			=> $module['id'],
							'user_category_id'	=> $user_category_id,
							'is_view'			=> (isset($priv_module[0]) ? $priv_module[0] : 0),
							'is_insert'			=> (isset($priv_module[1]) ? $priv_module[1] : 0),
							'is_update'			=> (isset($priv_module[2]) ? $priv_module[2] : 0),
							'is_delete'			=> (isset($priv_module[3]) ? $priv_module[3] : 0),
							'is_approve'		=> (isset($priv_module[4]) ? $priv_module[4] : 0)
						);
					$check_available_priv = $this->user_category_model->check_available_priv($module['id'], $user_category_id);
					if($check_available_priv == NULL){
						$save_priv = $this->user_category_model->add_privileges($data_priv);
						if($save_priv == 0){
							echo "Error simpan data privileges";die;
						}
					} else{
						$update_priv = $this->user_category_model->update_privileges($check_available_priv, $data_priv);
						if($update_priv != TRUE){
							echo "Error simpan data privileges";die;
						}
					}
				}
			}

			redirect('user_category/privileges/'.$id);
		}

		$data['all_priv_modules'] = $all_priv_modules;

		$this->load->view('user_category/privileges', $data);
	}
}
