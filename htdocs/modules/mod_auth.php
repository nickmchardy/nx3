<?php

/**
* nx3 Module: Auth
* 
* Provides a login box for users who have not logged in and a logout link for those who have.
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

  if (auth_logged_in($db))
  {
    $arr_content["nx3_auth_username"] = $_SESSION['NX3_USER']['username'];
  }

?>