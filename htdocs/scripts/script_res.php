<?php

/**
* nx3 Script Module: Res
* 
* Provides the ability to deliver resources stored as blobs in the nx3 database.
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

function script_handler($db, $obj_user, $content, $action, $smarty_template_file)
{
  // Validate parameters
  if (!isset($GLOBALS['NX3_PARAM_ARRAY'][2]))
  {
    fatal_error_handler ($db, "No resource specified.");
  }

  $get_res_id = $GLOBALS['NX3_PARAM_ARRAY'][2];

  // Fetch resource. Also check if user is able to access resource (apply security).
  $result_res_details = func_db_query($db, 'SELECT r.res_id, r.res_content_type, r.res_content_expiry, r.enabled_yn
    FROM @TABLE_PREFIX@nx3_res r WHERE r.res_id = ? AND r.res_id IN @RES_SECURITY@', array("i", $get_res_id));

  $res_id = $result_res_details[0]['res_id'];
  $res_content_type = $result_res_details[0]['res_content_type'];
  $res_content_expiry = $result_res_details[0]['res_content_expiry'];
  $res_enabled_yn = $result_res_details[0]['enabled_yn'];
      
  // Perform checks of result set
  if ($res_id == '')
  {
    fatal_error_handler ($db, "Requested resource ID " . $get_res_id . " does not exist or you do not have access to the resource.");
  }
  if ($res_enabled_yn != 'Y')
  {
    fatal_error_handler ($db, "Requested resource ID " . $get_res_id . " is not enabled.");
  }
  
  // Get BLOB (does not use prepared statements due to issues with prepared statements and blobs)
  $result = func_db_query_old_skool($db, "SELECT res_blob FROM @TABLE_PREFIX@nx3_res WHERE res_id = $res_id LIMIT 1", true);
  $res_blob = $result[0]['res_blob'];
  
  // change the content-type so the browser knows how to handle it
  header("Content-type: " . $res_content_type);
  
  // set the content expiry thing so the browser doesn't reload the same res file every time the browser reloads
  header("Cache-Control: cache");
  if ($res_content_expiry == 0)
  {
    // Use system-wide default
    header("Expires: " . gmdate("D, d M Y H:i:s", time() + lookup_setting($db, 'nx3.res.contentexpiry')) . " GMT");    
  }
  else
  {
    // Use resource-specific expiry
    header("Expires: " . gmdate("D, d M Y H:i:s", time() + $res_content_expiry) . " GMT");    
  }

  // Return the resource's data
  return $res_blob;
}
 
?>