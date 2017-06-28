<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function check_privilege($modul, $type)
  {
    $CI =& get_instance();

    $module_id = db_get_one_data('id', 'modules', array('module_name'=>$modul));

    $priv = $CI->db->get_where('user_privileges', array('user_category_id'=>$_SESSION['login']['user_category'], 'module_id'=>$module_id, $type=>1))->row_array();

    if($priv != NULL){
      return TRUE;
    } else{
      return FALSE;
    }
  }

  function left_menu()
  {
    $CI =& get_instance();
    $master_menu = $CI->db->query("SELECT * FROM modules a WHERE 
        ( a.id_parent = 0 AND a.id IN ( SELECT module_id FROM user_privileges WHERE user_category_id = ".$_SESSION['login']['user_category']." AND module_id = a.id AND is_view = 1 ) ) 
        OR 
        ( a.id_parent IS NULL AND a.id IN ( SELECT id_parent FROM user_privileges z INNER JOIN modules x ON z.module_id = x.id WHERE user_category_id = ".$_SESSION['login']['user_category']." AND x.id_parent = a.id AND z.is_view = 1 ) ) ORDER BY no_urut ASC")->result_array();

    $all_menu = '';
    foreach($master_menu as $mastermenu){
      if($mastermenu['id_parent'] != NULL){
        $all_menu .= '<li>
                          <a href="'.base_url().$mastermenu['module_url'].'" class=" hvr-bounce-to-right"><span class="nav-label">'.$mastermenu['module_alias'].'</span></a>
                      </li>';
      } else{
        $sub_menu = $CI->db->query("SELECT b.* FROM user_privileges a RIGHT JOIN modules b ON a.module_id = b.id WHERE a.user_category_id = ".$_SESSION['login']['user_category']." AND b.id_parent = ".$mastermenu['id']." ORDER BY no_urut ASC")->result_array();
        $all_menu .= '<li>
                        <a href="#" class=" hvr-bounce-to-right"><span class="nav-label">'.$mastermenu['module_alias'].'</span><span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">';
        foreach($sub_menu as $submenu){
          $all_menu .= '<li><a href="'.base_url().$submenu['module_url'].'" class=" hvr-bounce-to-right hvr-submenu">'.$submenu['module_alias'].'</a></li>';
        }
        $all_menu .= '</ul>
                  </li>';
      }
    }

    $data['left_menu'] = $all_menu;

    return $data;
  }