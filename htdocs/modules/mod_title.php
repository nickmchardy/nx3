<?php

/**
* nx3 Module: Title
* 
* Provides the page title.
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

  // Look up requested content module & set page title
  $result_modules = func_db_query($db, "SELECT module_name FROM " 
                       . constant("table_prefix") . "nx3_module WHERE module_code = ? LIMIT 1"
                       , array("s", $c));
  $arr_content["nx3_title"] = $result_modules[0]['module_name'];

?>
