<?php

/**
* nx3 Content Module: Login
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
*  1.0     | 11-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "")
  {
    return array();
  }
  elseif ($action == "auth")
  {
    define("PAGE_HEADING", "Login");
    
    // Only attempt to log in if not already logged in
    if (!auth_logged_in($db))
    {
      // Attempt to validate username/password
      auth_login($db, $_POST['username'], $_POST['password']);  
    }
    else
    {
      // User was already logged in previously
      return array('content_login_username' => $_SESSION['NX3_USER']['display_name']);
    }
    
    // Now, check if the login attempt was successful
    if (auth_logged_in($db))
    {
      return array('content_login_username' => $_SESSION['NX3_USER']['display_name'], 'content_login_target' => $_POST['target']);
    }
    else
    {   
      return array('content_login_fail' => true);
    }   
  }
  else if ($action == 'logout')
  {
    define("PAGE_HEADING", "Logout");
    auth_logout($db);
    
    return array();
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

?>