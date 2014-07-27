<?php

/**
* nx3 Content Module: Admin Maintenance
* 
* Admin module to run misc. process such as purging logs or recompiling templates
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 19-Jan-2010  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "")
  {
    define("PAGE_HEADING", "Admin Site Maintenance");
    return action_default($db, $obj_user);
  }
  elseif ($action == "purgelogs")
  {
    define("PAGE_HEADING", "Admin Site Maintenance - Purge Logs");
    return action_purgelogs($db, $obj_user);
  }
  elseif ($action == "recompiletemplates")
  {
    define("PAGE_HEADING", "Admin Site Maintenance - Recompiling Templates");
    return action_recompiletemplates($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{ 
  // Return nothing. The template will contain a menu of processes the admin can execute.
  return array();
}

function action_purgelogs($db, $obj_user)
{ 
  func_db_query($db, "DELETE FROM @TABLE_PREFIX@nx3_log_usage WHERE request_datetime < DATE_ADD(NOW(), INTERVAL -30 DAY)", null);
    
  return array();
}

function action_recompiletemplates($db, $obj_user)
{ 
  $db_result = func_db_query($db, "SELECT 2 AS orderby, m.module_code, m.module_name, m.template_file FROM @TABLE_PREFIX@nx3_module m
    WHERE m.enabled_yn = 'Y' AND m.template_file IS NOT NULL
    UNION SELECT 1, '_INDEX', 'Main Website Template', 'index.tpl'
    ORDER BY 1, 2", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_maintenance_modules'][] = array('module_code' => $row_data['module_code'], 
      'module_name' => $row_data['module_name'],
      'template_file' => $row_data['template_file']
      );
      
    // Invoke Smarty Template Engine to compile all available template modules.
    $smarty_recompile = new Smarty;
    $smarty_recompile->template_dir = lookup_setting($db, 'smarty.template.location');
    $smarty_recompile->compile_dir = lookup_setting($db, 'smarty.compile.location');
    $smarty_recompile->config_dir = lookup_setting($db, 'smarty.config.location');
    $smarty_recompile->compile_check = true; // Always Recompile
    $smarty_recompile->_compile_resource($row_data['template_file'], $smarty_recompile->_get_compile_path($row_data['template_file']));
  }
  
  return $page_content;
}

?>