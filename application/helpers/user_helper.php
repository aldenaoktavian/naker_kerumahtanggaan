<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*if ( ! function_exists('get_user_details')){
   function get_user_details($user_id,$modul){
      $ci =& get_instance();
     //load databse library
      $ci->load->database();
      $ci->db->select('user_category_id'); 
      $ci->db->where('id', $user_id);
      $id_kat = $this->db->get('users'); 

      $priv = $ci->db->get_where('user_priviledges',array('user_category_id'=>$id_kat->row()->user_category_id),'module_id'=>$modul);

      $data = array();
      if($priv->num_rows() > 0) {
        foreach ($priv->result() as $row) {
          $data['is_view'] = ($row->is_view == 1) ? 1 : 0;
          $data['is_insert'] = ($row->is_insert == 1) ? 1 : 0;
          $data['is_update'] = ($row->is_update == 1) ? 1 : 0;
          $data['is_delete'] = ($row->is_delete == 1) ? 1 : 0;
        }
        return $data;
      }else{
        return false;
      }
   }
}
*/