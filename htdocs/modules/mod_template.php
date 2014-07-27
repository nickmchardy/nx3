<?php

/**
* nx3 Module: Template
* 
* Provides the basic layout for a page sourced from a template.
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

  // Load default template if no template was specified
  if (!isset($t))
  {
    $t = lookup_setting($db, 'nx3.template.default');
  
    if ($t == '')
    {
      fatal_error_handler($db, "Default template not configured.");
    }
  }
  
  $result_templates = func_db_query($db, "SELECT template_file_path FROM @TABLE_PREFIX@nx3_template WHERE template_code = ? AND enabled_yn = 'Y' LIMIT 1"
                       , array("s", $t));
  $layoutfile = $result_templates[0]['template_file_path'];
  
  // Check if specified template exists in the db & is enabled
  if ($layoutfile == '')
  {
    fatal_error_handler($db, "Selected template '" . $t . "' is disabled or does not exist.");
  }
  
  // Load Template From File  
  if (!file_exists($layoutfile))
  {
    fatal_error_handler($db, "Invalid template was selected or it could not be found ('" . $layoutfile . "')");
  }
  else
  {
    $fp = fopen($layoutfile, "r");
    $arr_content[">#_LAYOUT_#<"] = fread($fp, lookup_setting($db, 'nx3.global.maximumfilesize'));
    fclose($fp);
  }

?>
