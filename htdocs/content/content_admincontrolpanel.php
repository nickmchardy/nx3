<?php

/**
* nx3 Content Module: Admin Control Panel
* 
* Description.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 24-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

  function content_handler($db, $obj_user, $content, $action, $template)
  {
    define("PAGE_HEADING", "Admin Control Panel");
    
    $result_admin_modules = func_db_query($db, "SELECT m.module_code, m.module_name, m.module_description, m.admin_link
      FROM @TABLE_PREFIX@nx3_module m WHERE m.admin_link IS NOT NULL AND m.enabled_yn = 'Y'", null);

    $page_content = array();
    foreach ($result_admin_modules as $admin_module)
    {
      $page_content['content_admincontrolpanel_module_list'][] = array(
          'link' => $admin_module['admin_link']
        , 'name' => $admin_module['module_name']
        , 'description' => $admin_module['module_description']
        ); 
    }
    
    $page_content['content_admincontrolpanel_display_name'] = $obj_user['display_name'];
    
    return $page_content;
  }

?>