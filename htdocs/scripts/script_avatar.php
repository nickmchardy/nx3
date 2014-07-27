<?php

/**
* nx3 Script Module: Avatar
* 
* Provides the ability to deliver a user's avatar which has been stored in the database as a BLOB.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 07-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function script_handler($db, $obj_user, $content, $action, $smarty_template_file)
{
  $get_user_id = $GLOBALS['NX3_PARAM_ARRAY'][2];
  
  // Validate parameters
  if ($get_user_id == '')
  {
    fatal_error_handler ($db, "No user specified.");
  }

  // Fetch Avatar
  $result_user_details = func_db_query($db, 'SELECT u.user_id, u.avatar_content_type FROM @TABLE_PREFIX@nx3_user u WHERE u.user_id = ?', 
    array("i", $get_user_id));

  $user_id = $result_user_details[0]['user_id'];
  $avatar_content_type = $result_user_details[0]['avatar_content_type'];
      
  // Perform checks of result set
  if ($user_id == '')
  {
    fatal_error_handler ($db, "Requested User ID " . $get_user_id . " does not exist.");
  }
  
  // Get BLOB (does not use prepared statements due to issues with prepared statements and blobs)
  $result = func_db_query_old_skool($db, "SELECT avatar FROM @TABLE_PREFIX@nx3_user WHERE user_id = $user_id LIMIT 1", true);
  
  // Deliver default avatar if no avatar was found
  if (!isset($result[0]) || $result[0][0] == '')
  {
    $default_avatar_file = lookup_setting($db, 'nx3.avatar.defaulturl');
    $avatar_content_type = lookup_setting($db, 'nx3.avatar.defaultcontenttype');
    if (!file_exists($default_avatar_file))
    {
      fatal_error_handler($db, "Could not find default avatar for users with no avatar (User_ID = '" . $user_id . "', Avatar file = '" . $default_avatar_file . "')");
    }
    $fp = fopen($default_avatar_file, "r");
    $user_avatar_blob = fread($fp, lookup_setting($db, 'nx3.global.maximumfilesize'));
    fclose($fp);
  }
  else
  {
    $user_avatar_blob = $result[0][0];
  }

  // change the content-type so the browser knows how to handle it
  header("Content-type: " . $avatar_content_type);
  
  // set the content expiry thing so the browser doesn't reload the same file every time the browser reloads
  header("Cache-Control: cache");
  header("Expires: " . gmdate("D, d M Y H:i:s", time() + lookup_setting($db, 'nx3.avatar.contentexpiry')) . " GMT");    

  // Return the avatar's data
  return $user_avatar_blob;
}
 
?>