<?php

/**
* nx3 Content Module: Profile
* 
* Displays a registered user's profile.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 18-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

  function content_handler($db, $obj_user, $content, $action, $template)
  {
    if ($action == 'view')
    {
      $user_id = $GLOBALS['NX3_PARAM_ARRAY'][2];

      $result_profile = func_db_query($db, 'SELECT u.user_id, u.display_name, u.status
        FROM @TABLE_PREFIX@nx3_user u WHERE u.user_id = ?', array("i", $user_id));
        
      if (!empty($result_profile))
      {
        define("PAGE_HEADING", 'Viewing User Profile: ' . $result_profile[0]['display_name']);
      
        return array('content_profile_display_name' => $result_profile[0]['display_name']
          , 'content_profile_user_id'=> $result_profile[0]['user_id']
          , 'content_profile_status'=> $result_profile[0]['status']);
      }
      else
      {
        define("PAGE_HEADING", 'Profile not found');
        return 'Profile not found!';
      }
    }
    else
    {
      fatal_error_handler ($db, "Specified action is not valid.");   
    }
  }
 
?>