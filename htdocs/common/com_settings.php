<?php

/**
* nx3 Common Module: Settings
* 
* Provides the ability to store & retrieve system settings. Settings are cached as constants.
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
function lookup_setting($db, $str_setting)
{
  if (defined('SETTING_' . $str_setting))
  {
    // Return value from memory - should be a slight performance gain by doing this
    return constant('SETTING_' . $str_setting);
  }
  else
  {
    // Lookup value in db, do not apply security
    $result_setting = func_db_query($db, "SELECT value FROM @TABLE_PREFIX@nx3_setting WHERE field = ?", array("s", $str_setting), false);
    
    if ($result_setting == null)
      fatal_error_handler ($db, "Global setting '" . $str_setting . "' not found in database.");
    
    $str_value = $result_setting[0]['value'];

    // Store value in memory
    define('SETTING_' . $str_setting, $str_value);
          
    return $str_value;
  }
}

?>